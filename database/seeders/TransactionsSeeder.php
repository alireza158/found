<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('transactions')->upsert([
            [
                'id' => 1,
                'passbook_id' => 1,
                'member_id' => 1,
                'period_id' => 1,
                'type' => 'contribution',
                'direction' => 'in',
                'amount' => 100000,
                'ref_type' => 'contribution',
                'ref_id' => 1,
                'occurred_at' => '2026-01-05 10:00:00',
                'description' => 'واریز اشتراک علی رضایی',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'passbook_id' => 1,
                'member_id' => 2,
                'period_id' => 1,
                'type' => 'contribution',
                'direction' => 'in',
                'amount' => 100000,
                'ref_type' => 'contribution',
                'ref_id' => 2,
                'occurred_at' => '2026-01-07 11:00:00',
                'description' => 'واریز اشتراک زهرا محمدی',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'passbook_id' => 1,
                'member_id' => 1,
                'period_id' => 2,
                'type' => 'loan_disbursement',
                'direction' => 'out',
                'amount' => 3000000,
                'ref_type' => 'loan',
                'ref_id' => 1,
                'occurred_at' => '2026-02-10 12:00:00',
                'description' => 'پرداخت وام به علی رضایی',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'passbook_id' => 4,
                'member_id' => 1,
                'period_id' => 3,
                'type' => 'installment_payment',
                'direction' => 'in',
                'amount' => 1100000,
                'ref_type' => 'installment',
                'ref_id' => 1,
                'occurred_at' => '2026-03-10 12:00:00',
                'description' => 'پرداخت قسط اول وام علی',
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'passbook_id' => 1,
                'member_id' => null,
                'period_id' => 1,
                'type' => 'expense',
                'direction' => 'out',
                'amount' => 50000,
                'ref_type' => 'expense',
                'ref_id' => 1,
                'occurred_at' => '2026-01-12 13:00:00',
                'description' => 'هزینه اداری',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['passbook_id', 'member_id', 'period_id', 'type', 'direction', 'amount', 'ref_type', 'ref_id', 'occurred_at', 'description', 'created_by', 'updated_at']);
    }
}