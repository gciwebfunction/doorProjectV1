<?php

namespace App\Models;

use App\Models\Product\ImageDetails;
use App\Models\Product\ProductOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $fillable = [
        'product_name',
        'prod_type',
        'height',
        'width',
        'color',
        'unit_price',
        'part_number',
        'image_id',
        'image_name',
        'prod_description',
        'category_id',
        'sort_order',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Setup finishes
     *
     * @return FinishOption
     */
    public function finishOptions()
    {
        return $this->belongsToMany(FinishOption::class, 'product_has_finish_options');
    }

    /**
     * Setup addon options
     *
     * @return AddOnOption
     */
    public function addOnOptions()
    {
        return $this->belongsToMany(AddOnOption::class, 'product_has_add_on_options');
    }

    public function images()
    {
        return $this->belongsToMany(ImageDetails::class, 'images_product', 'product_id', 'image_id');
    }

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }
}
