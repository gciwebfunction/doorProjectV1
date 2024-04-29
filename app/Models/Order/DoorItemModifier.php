<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoorItemModifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'door_item_id',
        'door_modifier_key',
        'door_modifier_value',
        'is_base_price',
        'price_multiplier',
        'price',
    ];

    public function doorItem()
    {
        return $this->belongsTo(DoorItem::class);
    }

}
