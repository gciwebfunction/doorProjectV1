<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;

    protected $table = 'contact_people';
    public $fillable = [
        'first_name',
        'last_name',
        'phone_number_id',
        'address_id',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
