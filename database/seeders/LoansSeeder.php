<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoansSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('loans')->upsert([
            [
                'id' => 1,
                'member_id' => 1,
                'passbook_id' => 4,
                'principal_amount' => 3000000,
                'fee_amount' => 300000,
                'total_amount' => 3300000,
                'installments_count' => 3,
                'start_date' => '2026-02-10',
                'status' => 'active',
                'draw_id' => null,
                'note' => 'وام ضروری',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'member_id' => 2,
                'passbook_id' => 5,
                'principal_amount' => 2400000,
                'fee_amount' => 240000,
                'total_amount' => 2640000,
                'installments_count' => 4,
                'start_date' => '2026-03-05',
                'status' => 'active',
                'draw_id' => null,
                'note' => 'وام خرید',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['member_id', 'passbook_id', 'principal_amount', 'fee_amount', 'total_amount', 'installments_count', 'start_date', 'status', 'draw_id', 'note', 'updated_at']);
    }
}