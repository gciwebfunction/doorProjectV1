<?php

namespace App\Models\Product\Door;

use App\Models\Product\ImageDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalOption extends Model
{
    use HasFactory;

    protected $table = 'additional_option_values';

    protected $fillable = [
        'door_id',
        'name',
        'group_name',
        'price',
        'is_per_panel',
        'is_per_light',
        'door_measurement_id',
        'multiplier',
        'image_id',
        'disabled',
        'has_price',
        'is_custom_option',
    ];

    public function door()
    {
        return $this->belongsTo(Door::class);
    }

    public function doorMeasurement()
    {
        return $this->belongsTo(DoorMeasurement::class);
    }

    public function image()
    {
        return $this->belongsTo(ImageDetails::class);
    }

}
