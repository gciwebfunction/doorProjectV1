<?php

namespace App\Models\Product\Door;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteriorColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
        'door_id',
    ];

    public function door()
    {
        return $this->belongsTo(Door::class);
    }
}
