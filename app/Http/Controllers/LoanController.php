<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Passbook;
use App\Models\Transaction;
use App\Services\LoanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::query()->with(['member'])->orderByDesc('id')->paginate(20);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::query()->where('is_active', true)->orderBy('full_name')->get();
        return view('loans.create', compact('members'));
    }

    public function store(Request $request, LoanService $svc)
    {
        $data = $request->validate([
            'member_id' => ['required','exists:members,id'],
            'principal_amount' => ['required','integer','min:1'],
            'fee_amount' => ['nullable','integer','min:0'],
            'installments_count' => ['required','integer','min:1','max:120'],
            'start_date' => ['required','date'],
            'note' => ['nullable','string','max:500'],
        ]);

        $central = Passbook::query()->where('type','central')->first();
        if (!$central) return back()->with('err','دفترچه صندوق مرکزی وجود ندارد (seed را اجرا کنید).');

        $member = Member::query()->findOrFail($data['member_id']);

        // ensure member has no active loan (rule can be changed)
        $activeLoan = Loan::query()->where('member_id', $member->id)->where('status','active')->exists();
        if ($activeLoan) return back()->with('err','این عضو وام فعال دارد.');

        $loan = null;

        DB::transaction(function () use (&$loan, $data, $central, $member, $svc) {
            $fee = (int)($data['fee_amount'] ?? 0);
            $principal = (int)$data['principal_amount'];

            $loan = Loan::query()->create([
                'member_id' => $member->id,
                'passbook_id' => $central->id,
                'principal_amount' => $principal,
                'fee_amount' => $fee,
                'total_amount' => $principal + $fee,
                'installments_count' => (int)$data['installments_count'],
                'start_date' => $data['start_date'],
                'status' => 'active',
                'note' => $data['note'] ?? null,
            ]);

            // Disbursement (outflow)
            Transaction::query()->create([
                'passbook_id' => $central->id,
                'member_id' => $member->id,
                'period_id' => null,
                'type' => 'loan_disbursement',
                'direction' => 'out',
                'amount' => $principal,
                'ref_type' => Loan::class,
                'ref_id' => $loan->id,
                'occurred_at' => now(),
                'description' => 'پرداخت وام',
                'created_by' => (int)session('ff_user_id'),
            ]);

            $svc->createInstallments($loan);
        });

        return redirect()->route('loans.show', $loan)->with('ok','وام ایجاد شد.');
    }

    public function show(Loan $loan)
    {
        $loan->load(['member','installments']);
        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        if ($loan->status !== 'active') return back()->with('err','فقط وام فعال قابل ویرایش است.');
        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, Loan $loan)
    {
        if ($loan->status !== 'active') return back()->with('err','فقط وام فعال قابل ویرایش است.');

        $data = $request->validate([
            'note' => ['nullable','string','max:500'],
        ]);

        $loan->update(['note' => $data['note'] ?? null]);
        return redirect()->route('loans.show', $loan)->with('ok','بروزرسانی شد.');
    }

    public function payInstallment(Request $request, Loan $loan, Installment $installment)
    {
        if ($installment->loan_id !== $loan->id) abort(404);

        $data = $request->validate([
            'amount' => ['required','integer','min:1'],
            'paid_at' => ['nullable','date'],
        ]);

        DB::transaction(function () use ($loan, $installment, $data) {
            $paidAt = $data['paid_at'] ?? now();
            $newPaid = (int)$installment->paid_amount + (int)$data['amount'];
            $status = 'partial';
            if ($newPaid >= (int)$installment->total_due) {
                $status = 'paid';
            }

            $installment->update([
                'paid_amount' => $newPaid,
                'paid_at' => $paidAt,
                'status' => $status,
            ]);

            Transaction::query()->create([
                'passbook_id' => $loan->passbook_id,
                'member_id' => $loan->member_id,
                'period_id' => null,
                'type' => 'installment_payment',
                'direction' => 'in',
                'amount' => (int)$data['amount'],
                'ref_type' => Installment::class,
                'ref_id' => $installment->id,
                'occurred_at' => $paidAt,
                'description' => 'پرداخت قسط وام',
                'created_by' => (int)session('ff_user_id'),
            ]);
        });

        return back()->with('ok','پرداخت قسط ثبت شد.');
    }

    public function settle(Loan $loan)
    {
        DB::transaction(function () use ($loan) {
            // mark all installments paid if fully covered (for MVP, just check totals)
            $totalDue = $loan->installments()->sum('total_due');
            $totalPaid = $loan->installments()->sum('paid_amount');
            if ($totalPaid < $totalDue) {
                throw new \RuntimeException('مجموع پرداختی اقساط کمتر از مبلغ کل است.');
            }
            $loan->update(['status' => 'settled']);
        });

        return back()->with('ok','وام تسویه شد.');
    }
}
