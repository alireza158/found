<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('members')->upsert([
            [
                'id' => 1,
                'full_name' => 'علی رضایی',
                'phone' => '09120000001',
                'national_id' => '0011111111',
                'is_active' => 1,
                'joined_at' => '2026-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'full_name' => 'زهرا محمدی',
                'phone' => '09120000002',
                'national_id' => '0022222222',
                'is_active' => 1,
                'joined_at' => '2026-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'full_name' => 'حسین کریمی',
                'phone' => '09120000003',
                'national_id' => '0033333333',
                'is_active' => 1,
                'joined_at' => '2026-01-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'full_name' => 'مریم احمدی',
                'phone' => '09120000004',
                'national_id' => '0044444444',
                'is_active' => 1,
                'joined_at' => '2026-02-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['full_name', 'phone', 'national_id', 'is_active', 'joined_at', 'updated_at']);
    }
}