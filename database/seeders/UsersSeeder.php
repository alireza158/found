<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->upsert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@familyfund.local',
                'password' => '$2y$12$v5Tv/.RDfKHq0zHXsZeP5OVFV2I4Ipq9MFGIjbBDcmzvog/7BRmtu',
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => '2026-02-22 19:45:56',
                'updated_at' => '2026-02-22 19:45:56',
            ],
            [
                'id' => 2,
                'name' => 'Staff One',
                'email' => 'staff1@familyfund.local',
                'password' => bcrypt('12345678'),
                'role' => 'staff',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['name', 'email', 'password', 'role', 'is_active', 'updated_at']);
    }
}