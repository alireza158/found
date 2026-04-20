<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Passbook;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::query()->orderByDesc('occurred_at')->paginate(30);
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'period_id' => ['nullable','integer'],
            'amount' => ['required','integer','min:1'],
            'occurred_at' => ['required','date'],
            'category' => ['required','string','max:120'],
            'description' => ['nullable','string','max:500'],
        ]);

        $central = Passbook::query()->where('type','central')->first();
        if (!$central) return back()->with('err','دفترچه صندوق مرکزی وجود ندارد (seed را اجرا کنید).');

        DB::transaction(function () use ($data, $central) {
            $e = Expense::query()->create([
                'period_id' => $data['period_id'] ?? null,
                'amount' => (int)$data['amount'],
                'occurred_at' => $data['occurred_at'],
                'category' => $data['category'],
                'description' => $data['description'] ?? null,
            ]);

            Transaction::query()->create([
                'passbook_id' => $central->id,
                'member_id' => null,
                'period_id' => $data['period_id'] ?? null,
                'type' => 'expense',
                'direction' => 'out',
                'amount' => (int)$data['amount'],
                'ref_type' => Expense::class,
                'ref_id' => $e->id,
                'occurred_at' => $data['occurred_at'],
                'description' => 'هزینه صندوق: '.$data['category'],
                'created_by' => (int)session('ff_user_id'),
            ]);
        });

        return redirect()->route('expenses.index')->with('ok','هزینه ثبت شد.');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'amount' => ['required','integer','min:1'],
            'occurred_at' => ['required','date'],
            'category' => ['required','string','max:120'],
            'description' => ['nullable','string','max:500'],
        ]);

        // MVP: update expense but NOT auto adjust old transaction.
        // In production: create adjustment transaction.
        $expense->update($data);

        return redirect()->route('expenses.index')->with('ok','بروزرسانی شد. (برای حسابرسی، در نسخه کامل سند اصلاحی اضافه می‌شود)');
    }
}
