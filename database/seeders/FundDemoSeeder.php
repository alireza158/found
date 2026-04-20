<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundDemoSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            MembersSeeder::class,
            PassbooksSeeder::class,
            PeriodsSeeder::class,
            ContributionPlansSeeder::class,
            ContributionsSeeder::class,
            LoansSeeder::class,
            InstallmentsSeeder::class,
            ExpensesSeeder::class,
            DrawsSeeder::class,
            TransactionsSeeder::class,
        ]);

        DB::table('loans')
            ->where('id', 1)
            ->update([
                'draw_id' => 1,
                'updated_at' => now(),
            ]);
    }
}