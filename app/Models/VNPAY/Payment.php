<?php

namespace App\Models\VNPAY;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table='payments';
    public $timestamps=false;
    protected $fillable = [
        'order_id',
        'thanh_vien',
        'money',
        'note',
        'vnp_response_code',
        'code_vnpay',
        'code_bank',
    ];
}
