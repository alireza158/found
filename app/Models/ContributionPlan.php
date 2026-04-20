<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContributionPlan extends Model
{
    protected $fillable = [
        'title','amount','start_period_id','end_period_id',
        'late_fee_type','late_fee_value'
    ];

    public function startPeriod(): BelongsTo
    {
        return $this->belongsTo(Period::class, 'start_period_id');
    }

    public function endPeriod(): BelongsTo
    {
        return $this->belongsTo(Period::class, 'end_period_id');
    }
}
