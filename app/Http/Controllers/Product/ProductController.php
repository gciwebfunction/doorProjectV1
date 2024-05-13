<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerUtilities;
use App\Http\Controllers\The;
use App\Models\AddOnOption;
use App\Models\Category;
use App\Models\FinishOption;
use App\Models\Product;
use App\Models\Product\ImageDetails;

use App\Models\Product\ProductOption;
use App\Models\Product\Door\DoorType;
use App\Models\Product\Door\InteriorColor;
use App\Models\ProductSizeCode;
use Illuminate\Http\Request;
use function redirect;
use function request;
use function view;

class ProductController extends Controller
{

    /**
     * @var ProductSizeCode[]|\Illuminate\Database\Eloquent\Collection
     */
    private $sizeCodes;

    public function __construct()
    {
        $this->middleware('auth');
        $this->sizeCodes = ProductSizeCode::all();
    }

    /**
     * Load the creation form for a product.  Add the categories from a fresh DB load.
     *
     * @return The create form.
     */
    public function createFlowStepOne()
    {
        $this->middleware('auth');

        return view('product.create.flow.stepone', [
            'categories' => Category::all(),
        ]);
    }

    public function createFlowStepTwo($id)
    {
        $this->middleware('auth');
        $product = Product::with(['addOnOptions'])->findOrFail($id);

        return view('product.create.flow.steptwo', [
            'product' => $product,
            'addOnOptions' => AddOnOption::all(),
            'finishOptions' => FinishOption::all(),
            'productSizeCodes' => ProductSizeCode::all(),
        ]);
    }

    public function storeFlowStepOne(Request $request)
    {
        $this->middleware('auth');
        $data = request()->validate([
            'product_name'          => 'required',
//            'other_product_image'   => ['image'],
            'product_description' => '',
            'product_category' => '',
        ]);

        $category       = Category::findOrFail($data['product_category']);
        $main_image     = $request->file('other_product_image');
        if (isset($main_image)) {
            $main_img_name =  $main_image->getClientOriginalName();
            $main_image->move(public_path('storage/product_image'), $main_img_name);
        }

        $product = Product::create([
            'product_name' => $data['product_name'],
            'prod_description' => $data['product_description'] ?? '',
            'category_id' => $category->id,
            'image_name' => $main_img_name,
        ]);

//        if ($image == '') {
//            $image = Product\ImageDetails::findOrFail(1);
//        }
//
//        $product->images()->attach($image);
//        $product->update(['image_id' => $image->id]);

        return redirect()->route('pcreateflowsteptwo', ['id' => $product->id]);
    }

    public
    function storeFlowSaveCategoryChanges()
    {
        $data = request()->validate([
            'category_name' => 'required',
            'product_id' => '',
        ]);

        $product = Product::findOrFail($data['product_id']);
        $category = $this->getOrCreateCategory($data['category_name']);
        $product->category_id = $category->id;
        $product->save();

        return view('product.create.flow.steptwo', [
            'product' => $product,
            'addOnOptions' => AddOnOption::all(),
            'finishOptions' => FinishOption::all(),
            'productSizeCodes' => ProductSizeCode::all(),
        ]);
    }

    public
    function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);

        $product->delete();

        return redirect()->route('pview', ['products' => Product::all()]);
    }

    public
    function deleteColor($productId)
    {
        $product = InteriorColor::findOrFail($productId);
        $product->delete();
        //return redirect()->route('pview', ['products' => Product::all()]);
    }

    public
    function storeFlowStepTwo()
    {
        $data = request()->all();
        $productId = $data['product_id'];
        $product = Product::findOrFail($productId);
        $options = [];
        $optionCount = $data['product_option_count'];

        for ($index = 0; $index < $optionCount; $index++) {
            $option = Product\ProductOption::create([
                'product_id' => $productId,
                'option_name' => '',
                'option_size' => $data['product_option_size-' . $index],
                'option_price' => $data['product_option_price-' . $index],
                'option_color' => $data['product_option_color-' . $index],
            ]);
            $options[] = $option;
        }

        return redirect()->route('pview', [
            'products' => \App\Models\Product::all()]);
    }

    private
    function saveFinishOptions(array $data)
    {
//        $product = Product::findOrFail($data['productId']);
//        $finishCount = $data['finishOptionCount'];
//        if (isset($finishCount)) {
//            for ($finishIndex = 0; $finishIndex < $finishCount; $finishIndex++) {
//                $finishOption = FinishOption::create([
//                    'finish_option_name' => $data['finishOption' . $finishIndex],
//                    'finish_option_price' => $data['finishPrice' . $finishIndex],
//                ]);
//                $product->finishOptions()->attach($finishOption);
//                $sizeCode = $this->getSizeCode($data['finishSizeCode' . $finishIndex]);
//                $finishOption->productSizeCodes->attach($sizeCode [
//                'add_on_option_price' => $data['addOnOptionPrice' . $addOnIndex],
//                        'product_id' => $productId
//                    ]););
//            }
//        }
    }

    /**
     * Find the size code id, or create a new size code.
     *
     * @param string $sizeCode
     * @return
     */
    private
    function getSizeCode(string $sizeCode): ProductSizeCode
    {
        foreach ($this->sizeCodes as $it) {
            if ($it->product_size_code == $sizeCode) {
                return $it;
            }
        }

        $newSizeCode = ProductSizeCode::create([
            'product_size_code' => $sizeCode,
        ]);

        $this->sizeCodes = ProductSizeCode::all();
        return $newSizeCode;
    }

    private
    function getOrCreateCategory($categoryName): Category
    {
        $category = '';
        $categories = Category::all();

        foreach ($categories as $c) {
            if ($c->category_name == $categoryName) {
                $category = $c;
            }
        }

        if ($category == '') {
            $category = Category::create($categoryName);
        }

        return $category;
    }
    public function ProductEdit($product_id){
        $product    = Product::where("id", $product_id)->with([
            "productOptions",
        ])->withCount('productOptions')->first();

        $image_id   =  $product->image_id;
        $image      = ImageDetails::where("id", $image_id)->first();
        //dd($image);

        //echo $product->image->image_path;die;

        return view('product.editscreen', [
            "product"   => $product,
            "image"     => $image,
        ]);
    }



    function updateProduct(Request $request){

        $data           = request()->all();

        if(array_key_exists('old_main_image',$data) && isset($data['old_main_image'])){
            $old_img_names = $data['old_main_image'];
        }

        $main_image     = $request->file('main_image');
        $old_img_names  = '';

        if($main_image){
            $main_img_name =  $main_image->getClientOriginalName();
            $main_image->move(public_path('storage/product_image'), $main_img_name);
        }else{
            $main_img_name = $old_img_names;
        }


        $product = Product::where("id", $data['product_id'])->update([
            "product_name"      => $data['product_name'],
            "part_number"       => $data['part_number'],
            "prod_description"  => $data['prod_description'],
            "image_name"        => $main_img_name,
        ]);



        ProductOption::where("product_id", $data['product_id'])->delete();

        $productCount = $data['product_option_count'];
        $arm = [];
        for($i = 0; $i < $productCount; $i++){
            ProductOption::create([
                "product_id" => $data['product_id'],
                "option_size" => request()->input("product_option_size-".$i),
                "option_color" => request()->input("product_option_color-".$i),
                "option_price" => request()->input("product_option_price-".$i),
                "option_name" => !empty(request()->input("custom_glass_option_name-".$i)) ? request()->input("custom_glass_option_name-".$i) : "",
            ]);
        }
        return redirect('p');
    }


    function updateProduct_bkk(){
        $data = request()->all();




        Product::where("id", $data['product_id'])->update([
            "product_name" => $data['product_name'],
            "part_number" => $data['part_number'],
            "prod_description" => $data['prod_description'],
        ]);

        ProductOption::where("product_id", $data['product_id'])->delete();

        $productCount = $data['product_option_count'];
        $arm = [];
        for($i = 0; $i < $productCount; $i++){
            ProductOption::create([
                "product_id" => $data['product_id'],
                "option_size" => request()->input("product_option_size-".$i),
                "option_color" => request()->input("product_option_color-".$i),
                "option_price" => request()->input("product_option_price-".$i),
                "option_name" => !empty(request()->input("custom_glass_option_name-".$i)) ? request()->input("custom_glass_option_name-".$i) : "",
            ]);
        }
        return redirect('p');
    }
    
    public function updateSortProduct(Request $request)
    {
        $productId     = $request->idd;
        $sortOrder     = $request->sort_order;
        $product       = Product::findOrFail($productId);
        //echo sort_order;die;
        $product->update([
            'id'            => $productId,
            'sort_order'    => $sortOrder,
        ]);
    }


}
