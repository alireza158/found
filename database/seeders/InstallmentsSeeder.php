<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstallmentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('installments')->upsert([
            [
                'id' => 1,
                'loan_id' => 1,
                'due_date' => '2026-03-10',
                'principal_part' => 1000000,
                'fee_part' => 100000,
                'total_due' => 1100000,
                'paid_amount' => 1100000,
                'paid_at' => '2026-03-10 12:00:00',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'loan_id' => 1,
                'due_date' => '2026-04-10',
                'principal_part' => 1000000,
                'fee_part' => 100000,
                'total_due' => 1100000,
                'paid_amount' => 0,
                'paid_at' => null,
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'loan_id' => 1,
                'due_date' => '2026-05-10',
                'principal_part' => 1000000,
                'fee_part' => 100000,
                'total_due' => 1100000,
                'paid_amount' => 0,
                'paid_at' => null,
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'loan_id' => 2,
                'due_date' => '2026-04-05',
                'principal_part' => 600000,
                'fee_part' => 60000,
                'total_due' => 660000,
                'paid_amount' => 300000,
                'paid_at' => '2026-04-05 15:00:00',
                'status' => 'partial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['loan_id', 'due_date', 'principal_part', 'fee_part', 'total_due', 'paid_amount', 'paid_at', 'status', 'updated_at']);
    }
}