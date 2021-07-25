<?php

namespace App\Models\Checkout;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table="customer";
    protected $fillable = [
        'name',
        'gender',
        'email',
        'address',
        'phone_number',
        'note',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'id_customer');
    }
}
