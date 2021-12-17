<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class PurchaseOrder extends Model
{
    use HasFactory;
    use Userstamps;

    protected $fillable = [
        'vendor_name'
    ];

    public function vendor(){
        return $this->belongsTo(VendorInfo::class, 'vendor_name', 'id');
    }
}
