<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassbooksSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('passbooks')->upsert([
            [
                'id' => 1,
                'member_id' => null,
                'title' => 'صندوق مرکزی',
                'type' => 'central',
                'is_active' => 1,
                'created_at' => '2026-02-22 19:45:56',
                'updated_at' => '2026-02-22 19:45:56',
            ],
            [
                'id' => 2,
                'member_id' => 1,
                'title' => 'پس‌انداز علی رضایی',
                'type' => 'savings',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'member_id' => 2,
                'title' => 'پس‌انداز زهرا محمدی',
                'type' => 'savings',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'member_id' => 1,
                'title' => 'وام علی رضایی',
                'type' => 'loan',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'member_id' => 2,
                'title' => 'وام زهرا محمدی',
                'type' => 'loan',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['member_id', 'title', 'type', 'is_active', 'updated_at']);
    }
}