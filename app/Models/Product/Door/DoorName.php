<?php

namespace App\Models\Product\Door;

use App\Models\Product\ImageDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoorName extends Model
{
    use HasFactory;

    protected $fillable = [
        'door_id',
        'door_name_or_type',
        'image_id',
    ];

    public function image()
    {
        return $this->belongsTo(ImageDetails::class);
    }

    public function door()
    {
        return $this->belongsTo(Door::class);
    }
}
