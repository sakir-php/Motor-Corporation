<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class SavingInvestor extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'name',
        'opening_date',
        'current_amount',
    ];

    public function investments()
    {
        return $this->hasMany(SavingInvestment::class, 'investor_id', 'id');
    }
}