<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItemModifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_item_id',
        'option_name',
        'option_type',
        'size_code',
        'option_additional_price',
    ];

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }

}
