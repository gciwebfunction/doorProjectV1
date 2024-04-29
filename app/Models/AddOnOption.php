<?php

namespace App\Models;

use App\Models\Product\ImageDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnOption extends Model
{
    use HasFactory;

    public $fillable = [
        'add_on_option',
        'add_on_option_description',
        'is_per_light',
        'is_per_panel',
        'is_price_same_for_all_sizes',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_has_add_on_options');
    }

    public function productSizeCodes()
    {
        return $this->belongsToMany(ProductSizeCode::class)->withPivot(['add_on_option_price', 'product_id']);
    }

    public function images()
    {
        return $this->belongsToMany(ImageDetails::class, 'add_on_options_images', 'add_on_option_id', 'image_id');
    }
}
