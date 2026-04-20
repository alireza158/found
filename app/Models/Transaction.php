<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    protected $fillable = [
        'passbook_id','member_id','period_id',
        'type','direction','amount',
        'ref_type','ref_id',
        'occurred_at','description','created_by'
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
        'amount' => 'integer'
    ];

    public function passbook(): BelongsTo
    {
        return $this->belongsTo(Passbook::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function ref(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'ref_type', 'ref_id');
    }
}
