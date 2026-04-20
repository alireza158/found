<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periods')->upsert([
            [
                'id' => 1,
                'year' => 2026,
                'month' => 1,
                'starts_at' => '2026-01-01',
                'ends_at' => '2026-01-31',
                'status' => 'closed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'year' => 2026,
                'month' => 2,
                'starts_at' => '2026-02-01',
                'ends_at' => '2026-02-28',
                'status' => 'closed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'year' => 2026,
                'month' => 3,
                'starts_at' => '2026-03-01',
                'ends_at' => '2026-03-31',
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['year', 'month', 'starts_at', 'ends_at', 'status', 'updated_at']);
    }
}