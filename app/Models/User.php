<?php

namespace App\Models;

use App\Models\Auth\Group;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Junges\ACL\Concerns\UsersTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';

    use HasApiTokens, HasFactory, Notifiable, UsersTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'disabled',
        'password',
        'usertype',
        'distributor_id',
        'associated_manufacturer'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function contactPeople()
    {
        return $this->hasMany(ContactPerson::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

}
