<?php

namespace App\Models\Checkout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table="bill_detail";
    protected $fillable = [
        'id_bill',
        'id_product',
        'quantity',
        'unit_price',
    ];
}
