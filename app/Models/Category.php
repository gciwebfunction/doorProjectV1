<?php

namespace App\Models;

use App\Models\Product\Door\Door;
use App\Models\Product\Door\DoorType;
use App\Models\Product\ImageDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_note',
        'category_name',
        'image',
        'image_id',
        'type',
        'sort_order'
    ];

    /**
     * Setup the relationship with products.
     *
     * @return mixed
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function doorTypes()
    {
        return $this->hasMany(DoorType::class);
    }

    public function image()
    {
        return $this->belongsTo(ImageDetails::class);
    }

    public function door()
    {
        return $this->hasMany(Door::class);
    }
}
