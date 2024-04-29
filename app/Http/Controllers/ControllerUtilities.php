<?php

namespace App\Http\Controllers;


use App\Models\Product\ImageDetails;

class ControllerUtilities
{

    public static function storeImage($file): ImageDetails
    {
        $imagePath = $file->store('product_image', 'public');

        return ImageDetails::create([
            'image_path' => $imagePath,
            'category_id' => -1,
        ]);
    }

    public static function storeImageForCategory($file, $category_id): ImageDetails
    {
        $imagePath = $file->store('product_image', 'public');

        return ImageDetails::create([
            'image_path' => $imagePath,
            'category_id' => $category_id,
        ]);
    }


    public static function storeImageForCategoryLatest($file, $category_id): ImageDetails
    {
        $imagePath = $file->store('product_image', 'public');

        return ImageDetails::create([
            'image_path' => $imagePath,
            'category_id' => $category_id,
        ]);
    }
}
