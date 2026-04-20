<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = [
        'period_id','amount','occurred_at','category','description','attachment_path'
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
        'amount' => 'integer',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}
