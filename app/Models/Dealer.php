<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    public $fillable = [
        'dealer_name',
        'primary_contact_id',
        'secondary_contact_id',
        'primary_phone_id',
        'secondary_phone_id',
        'primary_fax_id',
        'secondary_fax_id',
        'physical_address_id',
        'shipping_address_id',
        'credit_limit',
        'payment_term',
    ];

    public function contactPersons()
    {
        return $this->hasMany(ContactPerson::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }
}
