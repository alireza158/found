<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Passbook;
use App\Models\ContributionPlan;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@familyfund.local'],
            ['name' => 'Admin', 'password' => 'Admin@12345', 'role' => 'admin', 'is_active' => true]
        );

        Passbook::query()->firstOrCreate(
            ['type' => 'central'],
            ['member_id' => null, 'title' => 'صندوق مرکزی', 'is_active' => true]
        );

        ContributionPlan::query()->firstOrCreate(
            ['title' => 'اشتراک ماهانه'],
            ['amount' => 100000, 'late_fee_type' => 'none', 'late_fee_value' => 0]
        );
    }
}
