<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Invoice extends Model
{
    use HasFactory;
    use Userstamps;

    protected $fillable = [
        'payment_method_id',
        'discount_percentage',
        'fixed_discount',
        'note',
    ];

    public function payments(){
        return $this->hasMany(SalePayment::class, 'invoice_id', 'id');
    }
}




