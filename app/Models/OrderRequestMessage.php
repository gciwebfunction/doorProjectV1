<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\OrderRequest;

class OrderRequestMessage extends Model
{
    use HasFactory;
    public $fillable = [
        'message',
        'user_id',
        'order_request_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderRequestMessages()
    {
        return $this->belongsTo(OrderRequest::class);
    }
}
