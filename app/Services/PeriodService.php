<?php

namespace App\Services;

use App\Models\Contribution;
use App\Models\ContributionPlan;
use App\Models\Member;
use App\Models\Passbook;
use App\Models\Period;
use Illuminate\Support\Facades\DB;

class PeriodService
{
    public function generateContributions(Period $period): int
    {
        if ($period->status === 'closed') {
            throw new \RuntimeException('این دوره بسته شده است.');
        }

        $plan = ContributionPlan::query()->orderByDesc('id')->first();
        if (!$plan) {
            throw new \RuntimeException('پلن اشتراک تعریف نشده است.');
        }

        $count = 0;

        DB::transaction(function () use ($period, $plan, &$count) {
            $members = Member::query()->where('is_active', true)->get();

            foreach ($members as $m) {
                // unique: member+period+plan
                $exists = Contribution::query()
                    ->where('period_id', $period->id)
                    ->where('member_id', $m->id)
                    ->where('plan_id', $plan->id)
                    ->exists();

                if ($exists) continue;

                // default passbook: first savings passbook
                $passbookId = $m->passbooks()->where('type','savings')->value('id');

                Contribution::query()->create([
                    'period_id' => $period->id,
                    'member_id' => $m->id,
                    'passbook_id' => $passbookId,
                    'plan_id' => $plan->id,
                    'expected_amount' => $plan->amount,
                    'paid_amount' => 0,
                    'status' => 'unpaid',
                ]);

                $count++;
            }
        });

        return $count;
    }
}
