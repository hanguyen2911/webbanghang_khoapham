<?php

namespace App\Models\Checkout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = "bills";
    protected $fillable = [
        'id_customer',
        'date_order',
        'total',
        'payment',
        'note',
    ];
    // public function bills()
    // {
    //     return $this->hasMany(Customer::class, 'foreign_key', 'id_customer');
    // }
}
