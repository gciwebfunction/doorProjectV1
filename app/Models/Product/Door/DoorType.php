<?php

namespace App\Models\Product\Door;

use Illuminate\Database\Eloquent\Model;

class DoorType extends Model
{
    protected $table = 'door_types';

    protected $fillable = [
        'door_type',
        'door_type_pretty_name',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function doors()
    {
        return $this->hasMany(Door::class);
    }

}
