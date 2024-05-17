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

    //   protected $dates = ['expected_shipping_date'];
    protected $casts = [
        'expected_shipping_date' => 'date',  // 'date' is also an option if you only need the date part
    ];

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
        'current_level',
        'shipping_instruction',
        'package_instruction'
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
