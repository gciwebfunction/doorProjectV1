<?php

namespace App\Models\Order;

use App\Models\User;
use App\Models\OrderRequestMessage;
use App\Models\OrderRequestNote;
use App\Models\Order\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    use HasFactory;

    public $fillable = [
        'distributor_id',
        'dealer_id',
        'user_id',
        'ship_to',
        'ship_from',
        'po_number',
        'expected_shipping_date',
        'total',
        'status',
        'req_generator_type',
        'request_type',
        'current_level'
    ];

    public function doorItems()
    {
        return $this->hasMany(DoorItem::class);
    }

    public function orderRequestMessages()
    {
        return $this->hasMany(OrderRequestMessage::class);
    }

    public function orderRequestNotes()
    {
        return $this->hasMany(orderRequestNote::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
