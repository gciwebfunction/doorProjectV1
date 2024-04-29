<?php

namespace App\Http\Controllers\Product\Door;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product\Door\DoorType;

class DoorHelperController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDoorTypes($categoryName)
    {
        $category = Category::where('category_name', $categoryName)->first();

        if (isset($category)) {
            $doorTypes = DoorType::where('category_id', $category->id)->get();
            return response()->json($doorTypes);
        }

        return "";
    }
}
