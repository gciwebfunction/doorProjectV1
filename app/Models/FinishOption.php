<?php

namespace App\Models;

use App\Models\Product\ImageDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishOption extends Model
{
    use HasFactory;

    public $fillable = [
        'finish_option_name',
        'finish_option_description',
        'image_id',
    ];
    /**
     * @var mixed
     */
    private $id;

    /**
     * Define the owning product
     *
     * @return Product
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_has_finish_options');
    }

    public function productSizeCodes()
    {
        return $this->belongsToMany(ProductSizeCode::class)
            ->withPivot(['finish_option_price', 'product_id']);
    }

    public function relatedProductSizeCodes($productId)
    {

//dd(
        return
            $this->productSizeCodes()
                ->wherePivot('product_id', $productId)->get();
//        );
    }

    public function images()
    {
        return $this
            ->belongsToMany(ImageDetails::class, 'finish_options_images', 'finish_option_id', 'image_id');
    }
}
