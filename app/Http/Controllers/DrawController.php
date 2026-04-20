<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Draw;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Passbook;
use App\Models\Transaction;
use App\Services\LoanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DrawController extends Controller
{
    public function index()
    {
        $draws = Draw::query()->with(['period','winner'])->orderByDesc('id')->paginate(20);
        return view('draws.index', compact('draws'));
    }

    public function create()
    {
        return view('draws.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'period_id' => ['required','exists:periods,id'],
            'draw_date' => ['required','date'],
            'method' => ['required','in:random,manual'],
            'rules_json' => ['nullable','string'], // will be parsed as json if provided
        ]);

        $rules = null;
        if (!empty($data['rules_json'])) {
            $rules = json_decode($data['rules_json'], true);
            if (!is_array($rules)) $rules = null;
        }

        Draw::query()->create([
            'period_id' => (int)$data['period_id'],
            'draw_date' => $data['draw_date'],
            'method' => $data['method'],
            'rules_json' => $rules,
            'status' => 'planned',
        ]);

        return redirect()->route('draws.index')->with('ok','قرعه ایجاد شد.');
    }

    public function edit(Draw $draw)
    {
        return view('draws.edit', compact('draw'));
    }

    public function update(Request $request, Draw $draw)
    {
        if ($draw->status !== 'planned') return back()->with('err','فقط قرعه planned قابل ویرایش است.');

        $data = $request->validate([
            'draw_date' => ['required','date'],
            'method' => ['required','in:random,manual'],
            'winner_member_id' => ['nullable','exists:members,id'],
        ]);

        $draw->update($data);
        return redirect()->route('draws.index')->with('ok','قرعه بروزرسانی شد.');
    }

    public function run(Request $request, Draw $draw, LoanService $loanSvc)
    {
        if ($draw->status !== 'planned') return back()->with('err','این قرعه قبلاً اجرا شده یا لغو شده است.');

        $data = $request->validate([
            'loan_amount' => ['required','integer','min:1'],
            'fee_amount' => ['nullable','integer','min:0'],
            'installments_count' => ['required','integer','min:1','max:120'],
            'start_date' => ['required','date'],
        ]);

        $central = Passbook::query()->where('type','central')->first();
        if (!$central) return back()->with('err','دفترچه صندوق مرکزی وجود ندارد (seed را اجرا کنید).');

        DB::transaction(function () use ($draw, $data, $central, $loanSvc) {
            // eligibility: active members, no active loan, and no unpaid contribution in draw period
            $members = Member::query()->where('is_active', true)->get()
                ->filter(function ($m) use ($draw) {
                    $hasActiveLoan = Loan::query()->where('member_id',$m->id)->where('status','active')->exists();
                    if ($hasActiveLoan) return false;

                    $hasUnpaid = Contribution::query()->where('member_id',$m->id)->where('period_id',$draw->period_id)
                        ->where('status','!=','paid')->exists();
                    if ($hasUnpaid) return false;

                    return true;
                })->values();

            if ($members->isEmpty()) {
                throw new \RuntimeException('هیچ عضو واجد شرایطی پیدا نشد.');
            }

            $winner = $draw->winner_member_id
                ? Member::query()->findOrFail($draw->winner_member_id)
                : $members->random();

            $fee = (int)($data['fee_amount'] ?? 0);
            $principal = (int)$data['loan_amount'];

            $loan = Loan::query()->create([
                'member_id' => $winner->id,
                'passbook_id' => $central->id,
                'principal_amount' => $principal,
                'fee_amount' => $fee,
                'total_amount' => $principal + $fee,
                'installments_count' => (int)$data['installments_count'],
                'start_date' => $data['start_date'],
                'status' => 'active',
                'draw_id' => $draw->id,
                'note' => 'وام از طریق قرعه',
            ]);

            Transaction::query()->create([
                'passbook_id' => $central->id,
                'member_id' => $winner->id,
                'period_id' => $draw->period_id,
                'type' => 'loan_disbursement',
                'direction' => 'out',
                'amount' => $principal,
                'ref_type' => Loan::class,
                'ref_id' => $loan->id,
                'occurred_at' => now(),
                'description' => 'پرداخت وام (قرعه)',
                'created_by' => (int)session('ff_user_id'),
            ]);

            $loanSvc->createInstallments($loan);

            $draw->update([
                'winner_member_id' => $winner->id,
                'loan_id' => $loan->id,
                'status' => 'done',
            ]);
        });

        return back()->with('ok','قرعه اجرا شد و وام ایجاد شد.');
    }
}
