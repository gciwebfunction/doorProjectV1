<?php

namespace App\Models\Product\Door;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoorHandling extends Model
{
    use HasFactory;

    protected $fillable = [
        'handling',
        'door_id',
        'price',
        'handle_type',
    ];

    public function door()
    {
        return $this->belongsTo(Door::class);
    }
}
