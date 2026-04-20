<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'full_name','phone','national_id','is_active','joined_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'joined_at' => 'date',
    ];

    public function passbooks(): HasMany
    {
        return $this->hasMany(Passbook::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
