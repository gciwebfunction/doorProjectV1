<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $fillable = [
        'created_by_user_id',
        'original_order_request_user_id',
        'distributor_id',
        'requesting_dealer_id',
        'product_list_id',
        'ship_to',
        'ship_from',
        'total_order_amount',
        'purchase_order_number',
        'pay_term',
        'freight_term',
        'transportation_mode',
        'required_shipping_date',
        'scheduled_shipping_date',
        'product_inst',
        'prepared_by',
        'shipping_instruction',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
