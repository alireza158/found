<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('expenses')->upsert([
            [
                'id' => 1,
                'period_id' => 1,
                'amount' => 50000,
                'occurred_at' => '2026-01-12 13:00:00',
                'category' => 'هزینه اداری',
                'description' => 'خرید دفتر و لوازم',
                'attachment_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'period_id' => 2,
                'amount' => 75000,
                'occurred_at' => '2026-02-17 16:20:00',
                'category' => 'پیامک',
                'description' => 'هزینه اطلاع‌رسانی اعضا',
                'attachment_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['period_id', 'amount', 'occurred_at', 'category', 'description', 'attachment_path', 'updated_at']);
    }
}