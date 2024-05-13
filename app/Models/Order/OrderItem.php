<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'item',
        'prod_type',
        'prod',
        'spec',
        'width',
        'height',
        'panel_type',
        'door_type',
        'door_frame',
        'door_handling',
        'color_code',
        'glass_type',
        'glass_material',
        'glass_thickness',
        'handle',
        'lock',
        'lock_set_type',
        'lock_set_color',
        'predrill_type',
        'wall_thickness',
        'dp_option',
        'blind_option',
        'glass_grid',
        'lite_option',
        'frame_thickness',
        'sill_option',
        'screen_option',
        'handle_color',
        'lock_color',
        'sill_color',
        'hinge_color',
        'order',
        'quantity',
        'unit',
        'unit_price',
        'amount',
        'discount_type',
        'calculated_amount',
        'discount_amount'
    ];
}
