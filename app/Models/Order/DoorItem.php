<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   DoorItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_cart_id',
        'door_id',
        'door_name',
        'category_name',
        'door_type_pretty_name',
        'quantity',
        'price',
        'order_request_id',
        'assemble_knock'
    ];

    public function doorItemModifiers()
    {
        return $this->hasMany(DoorItemModifier::class);
    }

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

}
