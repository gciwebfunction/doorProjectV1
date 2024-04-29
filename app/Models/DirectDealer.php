<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectDealer extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'distributor_name',
        'primary_contact',
        'secondary_contact',
        'primary_phone',
        'secondary_phone',
        'primary_fax',
        'secondary_fax',
        'physical_address_id',
        'shipping_address_id',
        'credit_limit',
        'payment_term',
    ];

    public function physicalAddress()
    {
        return $this->hasOne(Address::class);
    }

    public function shippingAddress()
    {
        return $this->hasOne(Address::class);
    }
}
