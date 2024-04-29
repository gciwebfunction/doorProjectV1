<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerUtilities;
use App\Models\AddOnOption;
use App\Models\Product;
use App\Models\ProductSizeCode;

class ProductSizeCodeUtility
{

    public function __construct()
    {
    }

    /**
     * Find the size code id, or create a new size code.
     *
     * @param string $sizeCode
     * @return
     */
    public static function getSizeCode(string $sizeCode): ProductSizeCode
    {
        $sizeCodes = ProductSizeCode::all();

        foreach ($sizeCodes as $it) {
            if ($it->product_size_code == $sizeCode) {
                return $it;
            }
        }

        return ProductSizeCode::create([
            'product_size_code' => $sizeCode,
        ]);
    }

}
