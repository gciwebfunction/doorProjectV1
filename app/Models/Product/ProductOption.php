<?php

namespace App\Models\Product;

use App\Models\AddOnOption;
use App\Models\Category;
use App\Models\FinishOption;
#use App\Models\Order\ShoppingCart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = 'product_options';

    protected $fillable = [
        'product_id',
        'option_name',
        'option_size',
        'option_color',
        'option_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
//    public function productOption()
//    {
//        return $this->belongsTo(ShoppingCart::class);
//    }
}
