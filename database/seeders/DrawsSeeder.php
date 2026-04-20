<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrawsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('draws')->upsert([
            [
                'id' => 1,
                'period_id' => 2,
                'draw_date' => '2026-02-25',
                'method' => 'random',
                'rules_json' => json_encode([
                    'eligible_members' => [1, 2, 3],
                    'exclude_previous_winners' => true,
                ], JSON_UNESCAPED_UNICODE),
                'winner_member_id' => 1,
                'loan_id' => 1,
                'status' => 'done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'period_id' => 3,
                'draw_date' => '2026-03-25',
                'method' => 'manual',
                'rules_json' => json_encode([
                    'committee' => true,
                    'notes' => 'انتخاب توسط هیئت',
                ], JSON_UNESCAPED_UNICODE),
                'winner_member_id' => null,
                'loan_id' => null,
                'status' => 'planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['id'], ['period_id', 'draw_date', 'method', 'rules_json', 'winner_member_id', 'loan_id', 'status', 'updated_at']);
    }
}