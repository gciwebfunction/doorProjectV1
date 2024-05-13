<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_cart_id',
        'order_id',
        'order_request_id',
        'product_id',
        'product_name',
        'product_id',
        'product_name',
        'option_name',
        'product_size',
        'product_color',
        'quantity',
        'product_unit_price',
    ];

    public function cartItemModifiers()
    {
        return $this->hasMany(CartItemModifier::class);
    }

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }


}
