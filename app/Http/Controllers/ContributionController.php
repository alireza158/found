<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Passbook;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContributionController extends Controller
{
    public function index(Request $request)
    {
        $q = Contribution::query()->with(['member','period','plan'])
            ->orderByDesc('id');

        if ($request->filled('period_id')) {
            $q->where('period_id', (int)$request->period_id);
        }
        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }

        $contributions = $q->paginate(30);
        return view('contributions.index', compact('contributions'));
    }

    public function pay(Request $request, Contribution $contribution)
    {
        $data = $request->validate([
            'amount' => ['required','integer','min:1'],
            'paid_at' => ['nullable','date'],
            'note' => ['nullable','string','max:500'],
        ]);

        $central = Passbook::query()->where('type','central')->first();
        if (!$central) return back()->with('err','دفترچه صندوق مرکزی وجود ندارد (seed را اجرا کنید).');

        DB::transaction(function () use ($contribution, $data, $central) {
            $paidAt = $data['paid_at'] ?? now();

            $newPaid = (int)$contribution->paid_amount + (int)$data['amount'];
            $status = 'partial';
            if ($newPaid >= (int)$contribution->expected_amount) {
                $status = 'paid';
            }

            $contribution->update([
                'paid_amount' => $newPaid,
                'paid_at' => $paidAt,
                'status' => $status,
                'note' => $data['note'] ?? $contribution->note,
            ]);

            Transaction::query()->create([
                'passbook_id' => $central->id,
                'member_id' => $contribution->member_id,
                'period_id' => $contribution->period_id,
                'type' => 'contribution',
                'direction' => 'in',
                'amount' => (int)$data['amount'],
                'ref_type' => Contribution::class,
                'ref_id' => $contribution->id,
                'occurred_at' => $paidAt,
                'description' => 'پرداخت اشتراک ماهانه',
                'created_by' => (int)session('ff_user_id'),
            ]);
        });

        return back()->with('ok','پرداخت ثبت شد.');
    }
}
