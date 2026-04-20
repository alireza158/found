<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContributionPlansSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contribution_plans')->upsert([
            [
                'id' => 1,
                'title' => 'اشتراک ماهانه',
                'amount' => 100000,
                'start_period_id' => null,
                'end_period_id' => null,
                'late_fee_type' => 'none',
                'late_fee_value' => 0,
                'created_at' => '2026-02-22 19:45:57',
                'updated_at' => '2026-02-22 19:45:57',
            ],
            [
                'id' => 2,
                'title' => 'اشتراک ویژه',
                'amount' => 150000,
                'start_period_id' => 2,
                'end_period_id' => null,
                'late_fee_type' => 'fixed',
                'late_fee_value' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['title', 'amount', 'start_period_id', 'end_period_id', 'late_fee_type', 'late_fee_value', 'updated_at']);
    }
}