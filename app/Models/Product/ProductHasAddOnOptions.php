<?php

namespace App\Models\Product;

use App\Models\AddOnOption;

class ProductHasAddOnOptions extends Pivot
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function addOnOptions()
    {
        return $this->hasMany(AddOnOption::class);
    }
}
