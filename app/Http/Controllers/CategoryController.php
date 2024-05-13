<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product\ImageDetails;
use Illuminate\Support\Facades\Auth;
use Junges\ACL\Exceptions\UnauthorizedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('category.create');
    }

    public function show($id)
    {


        $user = Auth::user();
        if ($user->hasPermission('r_category')) {
            return view('category.viewone', ['category' => Category::findOrFail($id)]);
            //die('asdada');
        }

        $exception = UnauthorizedException::forPermissions(['r_category']);

        throw UnauthorizedException::forPermissions(['r_category']);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasPermission('c_category')) {
            throw UnauthorizedException::forPermissions(['u_category', 'r_category']);
        }
        //$image = '';
        //$uploaded = request('category_image');

        $data = request()->validate([
            'category_name' => 'required|unique:categories',
            'category_type' => 'required',
            'category_note' => '',
            'sort_order'    => '',
        ]);

        $note = '';
        if (isset($data['category_note']) || !$data['category_note'] == '') {
            $note = $data['category_note'];
        }

        $imageId = 1;
        //if (isset($data['image_id'])) {$data = $data['image_id'];}

        $file= $request->file('category_image');

        $caret_img_ne = $file->getClientOriginalName();
        if ($caret_img_ne) {
            $file->move(public_path('storage/category_image'), $caret_img_ne);
        }

        $category = Category::create([
            'category_name' => $data['category_name'],
            'category_note' => $note,
            'type'          => $data['category_type'],
            'image_id'      => $imageId,
            'image'         => $caret_img_ne,
            'sort_order'    => $data['sort_order']
        ]);

        /*if ($uploaded) {
            $image = ControllerUtilities::storeImage($uploaded, $category->id);
        }
        if ($image == '') {
            $image = ImageDetails::findOrFail(1);
        }*/

        return view('category.view', [
            'categories' => Category::all()
        ]);

    }

    // category update
    public function update(Request $request)
    {


        $user = Auth::user();
        if (!$user->hasPermission('c_category')) {
            throw UnauthorizedException::forPermissions(['u_category', 'r_category']);
        }
        $image = '';
        $uploaded = request('category_image');

        $data = request()->validate([
            'category_name'     => 'required',
            'category_note'     => '',
            'category_id'       => 'required',
            'old_image'         => '',
            'sort_order'        => '',
        ]);

        //dd($data);
        $category       = Category::findOrFail($data['category_id']);
        $file           = $request->file('category_image');

        if ($file) {
            $caret_img_ne   = $file->getClientOriginalName();
            $file->move(public_path('storage/category_image'), $caret_img_ne);
            if(array_key_exists('old_image' , $data)){
                //$old_image      = $data['old_image'];
                if(File::exists(public_path('storage/category_image/'.$data['old_image']))){
                    File::delete(public_path('storage/category_image/'.$data['old_image']));
                }
            }

        }else{

            if(array_key_exists('old_image',$data) && isset($data['old_image'])){
                $caret_img_ne = $data['old_image'];
            }else{
                $caret_img_ne = '';
            }
        }



        $note = '';

        if (isset($data['category_note'])) {
            $note = $data['category_note'];
        }

        $category->update([
            'category_name' => $data['category_name'],
            'category_note' => $note,
            'image_id'      => $image ? $image->id : $category->image_id,
            'image'         => $caret_img_ne,
            'sort_order'    => $data['sort_order'],
        ]);

        return redirect()->route('cview',
            ['categories' => \App\Models\Category::all()]);
    }


    /**
     * Delete a category.
     *
     * @param $categoryId - the Category to delete.
     * @return void
     */
    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $category->delete();
    }

    /**
     * Sort a category.
     *
     * @param $categoryId - the Category to Sort order.
     * @return void
     */
    public function updateSortCategory(Request $request)
    {
        $categoryId     = $request->idd;

        $sortOrder      = $request->sort_order;
        $category       = Category::findOrFail($categoryId);

        $category->update([
            'id' => $categoryId,
            'sort_order' => $sortOrder,
        ]);
    }

}
