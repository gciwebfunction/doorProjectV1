<?php

namespace App\Models;
//namespace App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Order\OrderRequest;


class OrderRequestNote extends Model
{
    use HasFactory;
    public $fillable = [
        'order_note',
        'user_id',
        'order_request_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderRequestNotes()
    {
        return $this->belongsTo(OrderRequest::class);
    }
}
