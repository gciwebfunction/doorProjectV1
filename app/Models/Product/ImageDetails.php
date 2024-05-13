<?php

namespace App\Models\Product;

use App\Models\AddOnOption;
use App\Models\Category;
use App\Models\FinishOption;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ImageDetails extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'image_path',
        'category_id',
        'flagged',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function addOnOption()
    {
        return $this->belongsTo(AddOnOption::class);
    }

    public function finishOption()
    {
        return $this->belongsTo(FinishOption::class);
    }
}
