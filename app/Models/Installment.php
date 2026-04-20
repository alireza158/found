<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installment extends Model
{
    protected $fillable = [
        'loan_id','due_date','principal_part','fee_part','total_due',
        'paid_amount','paid_at','status'
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'principal_part' => 'integer',
        'fee_part' => 'integer',
        'total_due' => 'integer',
        'paid_amount' => 'integer',
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}
