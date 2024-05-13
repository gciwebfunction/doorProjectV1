<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
    ];

    /**
     * Setup the relationship with products.
     *
     * @return mixed
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
