<?php

namespace App\Services;

use App\Models\Installment;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LoanService
{
    public function createInstallments(Loan $loan): void
    {
        $n = max(1, (int)$loan->installments_count);
        $principalEach = intdiv((int)$loan->principal_amount, $n);
        $feeEach = intdiv((int)$loan->fee_amount, $n);

        // remainder handling on last installment
        $principalR = (int)$loan->principal_amount - ($principalEach * $n);
        $feeR = (int)$loan->fee_amount - ($feeEach * $n);

        DB::transaction(function () use ($loan, $n, $principalEach, $feeEach, $principalR, $feeR) {
            $start = Carbon::parse($loan->start_date)->startOfDay();

            for ($i=1; $i<=$n; $i++) {
                $p = $principalEach;
                $f = $feeEach;
                if ($i === $n) {
                    $p += $principalR;
                    $f += $feeR;
                }

                Installment::query()->create([
                    'loan_id' => $loan->id,
                    'due_date' => $start->copy()->addMonths($i)->toDateString(),
                    'principal_part' => $p,
                    'fee_part' => $f,
                    'total_due' => $p + $f,
                    'paid_amount' => 0,
                    'status' => 'unpaid',
                ]);
            }
        });
    }
}
