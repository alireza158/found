<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Draw extends Model
{
    protected $fillable = [
        'period_id','draw_date','method','rules_json',
        'winner_member_id','loan_id','status'
    ];

    protected $casts = [
        'draw_date' => 'date',
        'rules_json' => 'array',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'winner_member_id');
    }
}
