<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_active',
        'token',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function doorItems()
    {
        return $this->hasMany(DoorItem::class);
    }

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }

}
