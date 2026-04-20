<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    protected $fillable = [
        'member_id','passbook_id','principal_amount','fee_amount','total_amount',
        'installments_count','start_date','status','draw_id','note'
    ];

    protected $casts = [
        'start_date' => 'date',
        'principal_amount' => 'integer',
        'fee_amount' => 'integer',
        'total_amount' => 'integer',
        'installments_count' => 'integer',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function passbook(): BelongsTo
    {
        return $this->belongsTo(Passbook::class);
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }
}
