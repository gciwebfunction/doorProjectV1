<?php

namespace App\Models\Product\Door;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoorFinishPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'door_measurement_id',
        'interior_color_id',
        'price',
    ];

    public function doorMeasurement()
    {
        return $this->belongsTo(DoorMeasurement::class);
    }

    public function interiorColor()
    {
        return $this->belongsTo(InteriorColor::class);
    }

}
