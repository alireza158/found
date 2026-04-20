<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContributionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contributions')->upsert([
            [
                'id' => 1,
                'period_id' => 1,
                'member_id' => 1,
                'passbook_id' => 1,
                'plan_id' => 1,
                'expected_amount' => 100000,
                'paid_amount' => 100000,
                'paid_at' => '2026-01-05 10:00:00',
                'status' => 'paid',
                'note' => 'پرداخت کامل دوره اول',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'period_id' => 1,
                'member_id' => 2,
                'passbook_id' => 1,
                'plan_id' => 1,
                'expected_amount' => 100000,
                'paid_amount' => 100000,
                'paid_at' => '2026-01-07 11:00:00',
                'status' => 'paid',
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'period_id' => 2,
                'member_id' => 1,
                'passbook_id' => 1,
                'plan_id' => 1,
                'expected_amount' => 100000,
                'paid_amount' => 100000,
                'paid_at' => '2026-02-04 09:00:00',
                'status' => 'paid',
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'period_id' => 2,
                'member_id' => 2,
                'passbook_id' => 1,
                'plan_id' => 1,
                'expected_amount' => 100000,
                'paid_amount' => 50000,
                'paid_at' => '2026-02-06 14:30:00',
                'status' => 'partial',
                'note' => 'بخشی از مبلغ پرداخت شد',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'period_id' => 3,
                'member_id' => 3,
                'passbook_id' => 1,
                'plan_id' => 2,
                'expected_amount' => 150000,
                'paid_amount' => 0,
                'paid_at' => null,
                'status' => 'unpaid',
                'note' => 'در انتظار پرداخت',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['period_id', 'member_id', 'passbook_id', 'plan_id', 'expected_amount', 'paid_amount', 'paid_at', 'status', 'note', 'updated_at']);
    }
}