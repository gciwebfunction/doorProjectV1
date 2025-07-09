<?php

use App\Models\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product\Door\AdditionalOption;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/o/EditManufacturerForm', [App\Http\Controllers\Cart\OrderController::class, 'EditManufacturerForm']);
Route::get('/o/test', [App\Http\Controllers\Cart\OrderController::class, 'test']);

Route::get('/about', function () {
    return view('aboutus');
})->name('aboutus');

Route::get('/test', function () {
    return view('test');
})->name('test');



Route::get('/dashboard', function () {

    $service = new \App\Service\CartService();
    $shoppingCart = $service->getUserCart(auth()->user()->id);

    //echo   auth()->user()->id;die;
    //dd($user->usertype);
    // order request notification


    return view('dashboard',
        [
            'categories'    => \App\Models\Category::all(),
            'doorTypes'     => \App\Models\Product\Door\DoorType::all(),
            'products'      => \App\Models\Product::all(),
            'shoppingCart'  => $shoppingCart,
            'status'        => \App\Models\Order\Status::all(),
            'orderRequests' => \App\Models\Order\OrderRequest::where('user_id', auth()->user()->id)->get()]);
})->middleware(['auth'])->name('dashboard');


Route::get('/category_dashboard/{id}', function () {

    $get_arr =  $_GET;
    if(array_key_exists( 'category_list' ,$get_arr)) $category_listidd = $_GET['category_list'];

     if(!empty($category_listidd )){
         $idd = $category_listidd;
     }else{
         $idd  = request('id');
     }



    $service = new \App\Service\CartService();
    $shoppingCart = $service->getUserCart(auth()->user()->id);
    // manual option for sortfselect

    /*$categories     =  DB::table('categories')->where('id', $idd)->get();
        //$products       =  DB::table('products')->where('category_id', $idd)->get();
        $products       = \App\Models\Product::where('category_id', $idd)->get();*/

    $categories     =  DB::table('categories')->where('id', $idd)->get();
    //$products       =  DB::table('products')->where('category_id', $idd)->get();
    $products       = \App\Models\Product::where('category_id', $idd)->orderBy('sort_order', 'asc')->get();
    
    $door_types     =  DB::table('door_types')->where('category_id', $idd)->get();
    $doors          =  DB::table('doors')->where('category_id', $idd)->orderBy('sort_order', 'asc')->get();

    //$categories[0]->category_name;
    //die;

    return view('category_dashboard', [
            'categories'    => $categories,
            'doorTypes'     => $door_types,
            'products'      => $products,
            'shoppingCart'  => $shoppingCart,
            'doors'         => $doors,
            'status'        => \App\Models\Order\Status::all(),
            'orderRequests' => \App\Models\Order\OrderRequest::where('user_id', auth()->user()->id)->get()]);
})->middleware(['auth']);


Route::get('/manufdashboard', function () {
    $service = new \App\Service\CartService();
    $shoppingCart = $service->getUserCart(auth()->user()->id);
    return view('manufdashboard',
        ['categories' => \App\Models\Category::all(),
            'products' => \App\Models\Product::all(),
            'doorTypes' => \App\Models\Product\Door\DoorType::all(),
            'shoppingCart' => $shoppingCart,
            'status' => \App\Models\Order\Status::all(),
            'orderRequests' => \App\Models\Order\OrderRequest::all(),
            'orders' => \App\Models\Order\Order::all(),
            //'orders' => \App\Models\Order\Order::all()->orderBy('door_id', 'asc'),
        ]);
})->middleware(['auth'])->name('manufdashboard');

/*Route::get('/', function () {
    //return view('welcome');
    return view('welcome', ['categories' => \App\Models\Category::all()]);
});*/
Route::get('/', function () {
    //sortByDesc

    $categories = \App\Models\Category::select('id',
        'category_name',
        'category_note',
        'image_id',
        'image',
        'type')->orderBy('type', 'asc')->get();
    return view('welcome', ['categories' => $categories ]);
});

//Route::post('/o/search', '\App\Http\Controllers\Cart\OrderController@search')->name('search');
Route::post('/search_result', function () {
    //$params = request()->all();
    $search = request()->search;

    $categories = \App\Models\Category::select('id',
        'category_name','category_note', 'image_id', 'image',
        'type')
        ->where('category_name', 'like', '%'.$search.'%')
        ->orderBy('type', 'asc')
        ->get();

    return view('search_result', ['categories' => $categories, 'searched' => $search  ]);
});
//Route::post('/search_result', '\App\Http\Controllers\Cart\OrderController@search')->name('search');

Route::get('/u/create', 'App\Http\Controllers\DetailedUserController@create')
    ->middleware('permissions:c_user')->name('ucreate');
//->middleware('groups:manuf-grp,slsmgr-grp')->name('ucreate');

Route::post('/u', 'App\Http\Controllers\DetailedUserController@store')
    ->middleware('groups:manuf-grp|slsmgr-grp')->name('ustore');
//Route::post('/u', 'App\Http\Controllers\DetailedUserController@store')
//    ->middleware('groups:manuf-grp')->name('ustore');

Route::post('/u/update', 'App\Http\Controllers\DetailedUserController@update')
    ->middleware('groups:manuf-grp,dist-grp')->name('uupdate');

Route::get('/u/view', 'App\Http\Controllers\DetailedUserController@view')
    ->middleware('permissions:r_user')->name('uview');
    //->middleware('groups:slsmgr-grp')->name('uview');

Route::get('/u/{id}', '\App\Http\Controllers\DetailedUserController@show')
    ->middleware('groups:manuf-grp')->name('ushow');;

Route::get('/u/toggleuser/{id}', '\App\Http\Controllers\DetailedUserController@toggle')
    ->middleware('auth')->name('utoggle');;

/*$categories = \App\Models\Category::getTable('categories')
    ->join('products', 'products.category_id', '=', 'categories.id')
    ->select('categories.*')
    ->get();*/


Route::get('/c', function () {
    return view('category.view', [ 'categories' => \App\Models\Category::withCount(['door','products'])
        ->groupBy('id')
        ->get() ] );


    /*Route::get('/c', function () {
        return view('category.view', [ 'categories' => DB::table('categories')
            ->leftjoin('products', 'products.category_id', '=', 'categories.id')
            ->select('categories.id','categories.category_name' , 'categories.category_note',DB::raw('count(products.id) as products_sum '))
            ->groupBy(DB::raw("categories.id"))
            ->get() ] );*/

})->middleware('permissions:r_category')->name('cview');

Route::get('/c/create', '\App\Http\Controllers\CategoryController@create')->name('ccreate');

Route::post('/c', '\App\Http\Controllers\CategoryController@store')->name('cstore');

Route::get('/c/{id}', '\App\Http\Controllers\CategoryController@show')->name('cshow');

Route::get('/c/edit/{category_id}', function ($category_id) {
    $category = \App\Models\Category::findOrFail($category_id);
    //dd($category->image->image_path);
    return view('category.edit', [
        'category' => $category,
    ]);
})->middleware('auth')
    ->name('categoryedit');

Route::post('/c/update', 'App\Http\Controllers\CategoryController@update')->middleware('auth')
    ->name('categoryupdate');

Route::get('/c/delete/{categoryId}', '\App\Http\Controllers\CategoryController@deleteCategory')
    ->middleware('auth')
    ->name('cdelete');

Route::post('/c/updateSortCategory','\App\Http\Controllers\CategoryController@updateSortCategory');


Route::get('/p', function () {
    return view('product.viewdoor', [
        'doors'         => \App\Models\Product\Door\Door::all(),
        'products'      => \App\Models\Product::all()]);
})->middleware('auth')->name('pview');

Route::post('/p/updateSortProduct','\App\Http\Controllers\Product\ProductController@updateSortProduct');
Route::post('/p/updateSortDoor','\App\Http\Controllers\Product\Door\DoorController@updateSortDoor');



Route::get('/p/createflowstepone', '\App\Http\Controllers\Product\ProductController@createFlowStepOne')->name('pcreateflowstepone');
Route::get('/p/createflowsteptwo/{id}', '\App\Http\Controllers\Product\ProductController@createFlowStepTwo')->name('pcreateflowsteptwo');

Route::get('/p/createdoorflowstepone', '\App\Http\Controllers\Product\Door\DoorController@createDoorFlowStepOne')->name('pcreatedoorflowstepone');
Route::get('/p/createdoorflowsteptwo/{id}', '\App\Http\Controllers\Product\Door\DoorController@createDoorFlowStepTwo')
    ->name('pcreatedoorflowsteptwo');
Route::get('/p/createdoorflowstepthree/{id}', function ($id) {
    ///dd(\App\Models\Product\Door\Door::findOrFail($id));
    return view('product.create.doorflow.stepthree',
        ['door' => \App\Models\Product\Door\Door::findOrFail($id)]);
})->middleware('auth')
    ->name('pcreatedoorflowstepthree');
Route::get('/p/createdoorflowstepfour/{id}', function ($id) {
    return view('product.create.doorflow.stepfour',
        ['door' => \App\Models\Product\Door\Door::findOrFail($id)]);
})->middleware('auth')
    ->name('pcreatedoorflowstepfour');
Route::get('/p/createdoorflowstepfive/{id}', function ($id) {
    return view('product.create.doorflow.stepfive',
        ['door' => \App\Models\Product\Door\Door::findOrFail($id)]);
})->middleware('auth')
    ->name('pcreatedoorflowstepfive');

Route::post('/p/doorflow/one', '\App\Http\Controllers\Product\Door\DoorController@storeDoorFlowStepOne')
    ->middleware('auth')
    ->name('pstoredoorflowstepone');
Route::post('/p/doorflow/two', '\App\Http\Controllers\Product\Door\DoorController@storeDoorFlowStepTwo')
    ->middleware('auth')
    ->name('pstoredoorflowsteptwo');
Route::post('/p/doorflow/three', '\App\Http\Controllers\Product\Door\DoorController@storeDoorFlowStepThree')
    ->middleware('auth')
    ->name('pstoredoorflowstepthree');
Route::post('/p/doorflow/four', '\App\Http\Controllers\Product\Door\DoorController@storeDoorFlowStepFour')
    ->middleware('auth')
    ->name('pstoredoorflowstepfour');
Route::post('/p/doorflow/five', '\App\Http\Controllers\Product\Door\DoorController@storeDoorFlowStepFive')
    ->middleware('auth')
    ->name('pstoredoorflowstepfive');

Route::get('/p/editdoorflowstepone/{id}', '\App\Http\Controllers\Product\Door\DoorController@editDoorFlowStepOne')->middleware('auth')->name('peditdoorflowstepone');

Route::get('/p/editdoorflowsteptwo/{id}', '\App\Http\Controllers\Product\Door\DoorController@editDoorFlowStepTwo')->middleware('auth')->name('peditdoorflowsteptwo');
Route::get('/p/editdoorflowstepthree/{id}', function ($id) {
    $door = \App\Models\Product\Door\Door::findOrFail($id);
    $uniqueOptions = [];
    foreach ($door->additionalOptions as $additionalOption) {
        $uniqueOptions[] = $additionalOption->group_name;
    }

    $to_remove = array('GLASS_GRID');
    $uniqueOptions = array_diff($uniqueOptions, $to_remove);

    //echo '<pre>'; var_dump($uniqueOptions); die;

    //dd($uniqueOptions);

    $doorId = $id;
    $addOn_option  = [];
    // set the glass grid
    // new logic for custom sort
    // Lite_grid
    $Lite_no_grid   =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )
                            AND name IN ( '1-Lite No Grid' )
                            -- ORDER BY SUBSTRING_INDEX(name, '-', -2) 
                            ");

    $Lite_no_grid_siz   = sizeof($Lite_no_grid);
    if($Lite_no_grid_siz > 0) $addOn_option = $Lite_no_grid;

    // sdl_grid
    $SDL_grid   =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )                            
                            AND name IN ( '2-Lite SDL','3-Lite SDL', '4-Lite SDL' ,'6-Lite SDL' ,'8-Lite SDL' ,'10-Lite SDL','12-Lite SDL', '15-Lite SDL' ,'18-Lite SDL' )
                            ORDER BY SUBSTRING(name, -11) asc;
                            ");
                            // ORDER BY SUBSTRING_INDEX(name, '-', -2)
                            // AND name IN ( '10-Lite SDL','12-Lite SDL', '15-Lite SDL' ,'18-Lite SDL' )
    $SDL_grid_siz   = sizeof($SDL_grid);
    if($SDL_grid_siz > 0)    $addOn_option = array_merge($addOn_option,$SDL_grid );



    // gbg_grid
    $GBG_grid   =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )
                            AND name IN ( '10-Lite GBG','12-Lite GBG', '15-Lite GBG' ,'18-Lite GBG' )
                            ORDER BY SUBSTRING_INDEX(name, '-', -2) ");
    $GBG_grid_siz   = sizeof($GBG_grid);
    if($GBG_grid_siz > 0)     $addOn_option = array_merge($addOn_option,$GBG_grid);



    // gbg_grid
    $GBG_grideq   =  DB::select("
                                SELECT * FROM `additional_option_values`
                                WHERE door_id = $doorId
                                AND disabled = 0    
                                AND group_name IN ( 'GLASS_GRID' )
                                AND name IN ( '10-Lite Equal Lite GBG','12-Lite Equal Lite GBG', '15-Lite Equal Lite GBG' ,'18-Lite Equal Lite GBG' )
                                 ORDER BY SUBSTRING_INDEX(name, '-', -2) 
                                ");
    $GBG_grid_sizeq   = sizeof($GBG_grideq);
    if($GBG_grid_sizeq > 0)
        $addOn_option = array_merge($addOn_option,$GBG_grideq);


    // gbg_grid_SDL
    $GBG_grid_SD        =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )
                            AND name IN ( '10-Lite SDL & GBG','12-Lite SDL & GBG', '15-Lite SDL & GBG', '18-Lite SDL & GBG' )
                             ORDER BY SUBSTRING_INDEX(name, '-', -2) 
                            ");

    $GBG_grid_SD_siz   = sizeof($GBG_grid_SD);
    if($GBG_grid_SD_siz > 0) $addOn_option = array_merge($addOn_option,$GBG_grid_SD);

    //dd($addOn_option);

    return view('product.edit.doorflow.stepthree',
        ['door'                 => $door,
            'uniqueOptionList'  => array_unique($uniqueOptions),
            'glassOptions'      => AdditionalOption::where('group_name', 'GLASS_OPTION')->where('door_id', $id)->get(),
            'addOn_option_GG'   =>  $addOn_option
//    @case('GLASS_OPTION')
//                                                        Glass Option
//                                                        @break
//    @case('GLASS_LOWE_OPTION')
//                                                        Glass Lowe Option
//                                                        @break
//    @case('GLASS_DEPTH_OPTION')
//                                                        Glass Depth Option
//                                                        @break
//    @case('HANDLE_TYPE_OPTION')
//                                                        Handle Type Option
//                                                        @break
//    @case('LOCK_SET_OPTION')
//                                                        Lock Set Option
//                                                        @break
//    @case('HARDWARE_COLOR_OPTION')
//                                                        Hardware Color Option
//                                                        @break
//    @case('FRAME_THICKNESS_OPTION')
//                                                        Frame Thickness Option
//                                                        @break
//    @case('GLASS_GRID')
//                                                        Glass Grid
        ]);
})->middleware('auth')->name('peditdoorflowstepthree');

Route::post('/p/editdoorflow/updatestepone', '\App\Http\Controllers\Product\Door\DoorController@updateDoorFlowStepOne')
    ->middleware('auth')
    ->name('pupdatedoorstepone');
Route::post('/p/editdoorflow/updatesteptwo', '\App\Http\Controllers\Product\Door\DoorController@updateDoorFlowStepTwo')
    ->middleware('auth')
    ->name('pupdatedoorsteptwo');
Route::post('/p/editdoorflow/updatestepthree', '\App\Http\Controllers\Product\Door\DoorController@updateDoorFlowStepThree')
    ->middleware('auth')
    ->name('pupdatedoorstepthree');

Route::get('/p/deleteAddOnOption/{addOnOptionId}/{sizeCodeId}', 'App\Http\Controllers\Product\OptionController@deleteAddOnOptionSizeCode')
    ->middleware('auth')
    ->name('pdeleteaddonoption');

Route::get('/p/deleteFinishOption/{finishOptionId}/{sizeCodeId}', 'App\Http\Controllers\Product\OptionController@deleteFinishOptionSizeCode')
    ->middleware('auth')
    ->name('pdeletefinishoption');

Route::get('/p/deleteDoorOption/{addOnOptionId}', 'App\Http\Controllers\Product\OptionController@deleteDoorOption')
    ->middleware('auth')
    ->name('pdeletedooroption');

Route::get('/p/deleteDoorHandling/{handlingId}', 'App\Http\Controllers\Product\OptionController@deleteDoorHandling')
    ->middleware('auth')
    ->name('pdeletedoorhandling');

Route::get('/p/deleteInteriorColor/{colorId}', 'App\Http\Controllers\Product\OptionController@deleteInteriorColor')
    ->middleware('auth')
    ->name('pdeleteinteriorcolor');

Route::get('/p/deleteDoorMeasurement/{measurementId}', 'App\Http\Controllers\Product\OptionController@deleteDoorMeasurement')
    ->middleware('auth')
    ->name('pdeletemeasurement');

Route::get('/p/delete/{productId}', '\App\Http\Controllers\Product\ProductController@deleteProduct')
    ->middleware('auth')
    ->name('pdelete');

Route::get('/p/deleteColor/{productId}', '\App\Http\Controllers\Product\ProductController@deleteColor')
    ->middleware('auth')
    ->name('pdeletecolor');


// Route::get('/p/deleteDoor/{doorId}', '\App\Http\Controllers\Product\Door\DoorController@deleteDoor')
//     ->middleware('auth')
//     ->name('pdeletedoor');

Route::get('/p/deleteDoor/{id}', '\App\Http\Controllers\Product\Door\DoorController@deleteDoor');


Route::post('/p/flow/one', '\App\Http\Controllers\Product\ProductController@storeFlowStepOne')
    ->middleware('auth')
    ->name('pstoreflowstepone');
Route::post('/p/flow/two', '\App\Http\Controllers\Product\ProductController@storeFlowStepTwo')
    ->middleware('auth')
    ->name('pstoreflowsteptwo');
Route::post('/p/flow/addonoption/{productId}', '\App\Http\Controllers\Product\OptionController@storeNewAddOnOption')
    ->middleware('auth')
    ->name('pstoreflowaddonoption');
Route::post('/p/flow/finishoption/{productId}', '\App\Http\Controllers\Product\OptionController@storeNewFinishOption')
    ->middleware('auth')
    ->name('pstoreflowfinishoption');
Route::get('/p/flow/changecategory/{productId}', function ($productId) {
    return view('product.create.flow.changecategory', [
        'product' => \App\Models\Product::findOrFail($productId),
        'categories' => \App\Models\Category::all(),
    ]);
})
    ->middleware('auth')
    ->name('pchangecategory');
Route::post('/p/flow/three', '\App\Http\Controllers\Product\ProductController@storeFlowSaveCategoryChanges')
    ->middleware('auth')
    ->name('pstoreflowstepthree');

Route::get('/p/{productId}', function ($productId) {
    return view('product.viewone', [
        'product' => \App\Models\Product::findOrFail($productId)]);
})
    ->middleware('auth')
    ->name('pshow');

require __DIR__ . '/auth.php';

Route::post('/perm/add/{groupId}', 'App\Http\Controllers\Auth\PermissionController@addPermissionToGroup')->name('permadd');
Route::get('/perm', '\App\Http\Controllers\Auth\PermissionController@view')->name('permview');
Route::get('/perm/viewuser', '\App\Http\Controllers\Auth\PermissionController@getPermissionsForUser')->name('permviewuser');


Route::post('/sc/addObject/{productId}/{shoppingCartId}',
    '\App\Http\Controllers\Cart\CartController@addItemToCart')
    ->middleware('auth')
    ->name('cartaddobject');
Route::post('/sc/addDoor/{productId}/{shoppingCartId}',
    '\App\Http\Controllers\Cart\CartController@addDoorToCart')
    ->middleware('auth')
    ->name('cartadddoor');
Route::get('/sc/view/{shoppingCartId}', '\App\Http\Controllers\Cart\CartController@viewCart')
    ->middleware('auth')
    ->name('cartview');
Route::get('/scdoor/view/{shoppingCartId}', '\App\Http\Controllers\Cart\CartController@viewDoorCart')
    ->middleware('auth')
    ->name('cartviewdoor');
Route::get('/sc/clearcart/{shoppingCartId}', '\App\Http\Controllers\Cart\CartController@clearCart')
    ->middleware('auth')
    ->name('cartclear');
Route::get('/sc/deleteItem/{id}', '\App\Http\Controllers\Cart\CartController@deleteCartItem')
    ->middleware('auth')
    ->name('scdeleteitem');
Route::get('/sc/deleteDoorItem/{id}', '\App\Http\Controllers\Cart\CartController@deleteCartDoorItem')
    ->middleware('auth')
    ->name('scdeletedooritem');

// For web.php (CSRF token required)
Route::get('/getHandiCapSillColorOptions/{id}/{door_measurement_id}', '\App\Http\Controllers\Cart\CartController@getHandiCapSillColorOptions' )->name('getHandiCapSillColorOptions');

Route::get('/sc/door/{id}/{doorid}', function ($id, $doorId) {
    //$dorr  = \App\Models\Product\Door\Door::findOrFail($doorId)->sortByDesc('additional_option_values.price');
    //additional_option_values
//    foreach($dorr->additionalOptions as $addOn){
//        //dd($addOn);
//    }

//    $addOn_optiontt   =  DB::select("
//                        SELECT * FROM `additional_option_values`
//                        WHERE door_id = $doorId
//                        AND disabled = 0
//                        ORDER BY price asc , group_name DESC");
//
//    echo sizeof($addOn_optiontt).'<hr>';

        // no grid
        // SELECT * FROM `additional_option_values` WHERE door_id = 1001 AND disabled = 0 and group_name = 'GLASS_GRID' and door_measurement_id =1001 and name in( '1-Lite No Grid' , '10-Lite SDL', '12-Lite SDL', '15-Lite SDL', '18-Lite SDL', '10-Lite GBG', '12-Lite GBG', '15-Lite GBG', '18-Lite GBG', '10-Lite SDL & GBG', '12-Lite SDL & GBG', '15-Lite SDL & GBG', '18-Lite SDL & GBG' );



        $addOn_option1   =  DB::select("
                            SELECT * FROM `additional_option_values` 
                            WHERE door_id = $doorId 
                            -- AND disabled = 0   AND group_name NOT IN != 'HANDLE_COLOR_OPTION'
                            AND disabled = 0   AND group_name NOT IN ('HANDLE_COLOR_OPTION' , 'LOCK_COLOR_OPTION' ,'HINGE_COLOR_OPTION' , 'SILL_COLOR_OPTION' , 'GLASS_GRID' ) 
                            ORDER BY price asc , group_name DESC");

        $addOn_option2   =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ('HANDLE_COLOR_OPTION' , 'LOCK_COLOR_OPTION' ,'HINGE_COLOR_OPTION' , 'SILL_COLOR_OPTION'  )
                            AND group_name NOT IN ( 'GLASS_GRID' )
                            ORDER BY name asc ");

        $addOn_opt_siz2   = sizeof($addOn_option2);
        if($addOn_opt_siz2 > 0){
            $addOn_option = array_merge($addOn_option1,$addOn_option2);
        }else{
            $addOn_option = $addOn_option1;
        }


        $griid_array111 = [];

        // new logic for custom sort
        // Lite_grid
        $Lite_no_grid   =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )
                            AND name IN ( '1-Lite No Grid' )
                            -- ORDER BY SUBSTRING_INDEX(name, '-', -2) 
                            ");

        $Lite_no_grid_siz   = sizeof($Lite_no_grid);
        if($Lite_no_grid_siz > 0) $addOn_option = array_merge($addOn_option,$Lite_no_grid);


        // sdl_grid
        $SDL_grid   =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )
                            AND name IN ( '2-Lite SDL','3-Lite SDL', '4-Lite SDL' ,'6-Lite SDL' ,'8-Lite SDL' ,'10-Lite SDL','12-Lite SDL', '15-Lite SDL' ,'18-Lite SDL' )
                            -- ORDER BY SUBSTRING_INDEX(name, '-', -2) 
                            ORDER BY SUBSTRING(name, -11) asc;
                            ");



        $SDL_grid_siz   = sizeof($SDL_grid);
        if($SDL_grid_siz > 0)    $addOn_option = array_merge($addOn_option,$SDL_grid );




        // gbg_grid
        $GBG_grid   =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )
                            AND name IN ( '10-Lite GBG','12-Lite GBG', '15-Lite GBG' ,'18-Lite GBG' )
                            -- AND name IN ( '2-Lite SDL','3-Lite SDL', '4-Lite SDL' ,'6-Lite SDL' ,'8-Lite SDL' ,'10-Lite SDL','12-Lite SDL', '15-Lite SDL' ,'18-Lite SDL' )
                            
                            ORDER BY SUBSTRING_INDEX(name, '-', -2) ");
        $GBG_grid_siz   = sizeof($GBG_grid);
        if($GBG_grid_siz > 0)     $addOn_option = array_merge($addOn_option,$GBG_grid);



        // gbg_grid
        $GBG_grideq   =  DB::select("
                                SELECT * FROM `additional_option_values`
                                WHERE door_id = $doorId
                                AND disabled = 0    
                                AND group_name IN ( 'GLASS_GRID' )
                                 AND name IN ( '10-Lite Equal Lite GBG','12-Lite Equal Lite GBG', '15-Lite Equal Lite GBG' ,'18-Lite Equal Lite GBG' )
                                

                                -- ORDER BY SUBSTRING_INDEX(name, '-', -2) 
                                ");
        $GBG_grid_sizeq   = sizeof($GBG_grideq);
         if($GBG_grid_sizeq > 0)  $addOn_option = array_merge($addOn_option,$GBG_grideq);



        // gbg_grid_SDL
        $GBG_grid_SD        =  DB::select("
                            SELECT * FROM `additional_option_values`
                            WHERE door_id = $doorId
                            AND disabled = 0    
                            AND group_name IN ( 'GLASS_GRID' )
                            AND name IN ( '10-Lite SDL & GBG','12-Lite SDL & GBG', '15-Lite SDL & GBG', '18-Lite SDL & GBG' )
                            -- ORDER BY SUBSTRING_INDEX(name, '-', -2) 
                            ");

        $GBG_grid_SD_siz   = sizeof($GBG_grid_SD);
        if($GBG_grid_SD_siz > 0) $addOn_option = array_merge($addOn_option,$GBG_grid_SD);


        //$dpoooo_date = \App\Models\Product\Door\DoorMeasurement::findOrFail($doorId);
        //echo '<pre>'; var_dump($dpoooo_date); die;




    $door_measurements        =  DB::select("
                            SELECT  id,width, height 
                                 FROM door_measurements WHERE door_id = $doorId
 
                            ");


    //echo '<pre>'; var_dump($door_measurements); die;


    //    $addOn_option   =  array_map(function ($value) {
    //        return (array)$value;
    //    }, $addOn_option);

    return view('shoppingcart.doortuning',
        [
            'door'              => \App\Models\Product\Door\Door::findOrFail($doorId),
            'addOn_option'      => $addOn_option,
            'door_id'            => $doorId,
            'door_measurements' => $door_measurements,

            'shoppingCart'      => \App\Models\Order\ShoppingCart::findOrFail($id),
            'doorHandlings2'    => \App\Models\Product\Door\DoorHandling::where([
                'door_id'       => $doorId,
                'handle_type'   => 1])->get(),
            'doorHandlings1'    => \App\Models\Product\Door\DoorHandling::where([
                'door_id'       => $doorId,
                'handle_type'   => 0])->get(),



        ]);
})->middleware('auth')
    ->name('shoppingcart.doortuning');
/*Route::get('/sc/door/{id}/{doorid}', function ($id, $doorId) {
        //$dorr  = \App\Models\Product\Door\Door::findOrFail($doorId)->toArray();
        //dd($dorr);

        return view('shoppingcart.doortuning',
            [
            'door'              => \App\Models\Product\Door\Door::findOrFail($doorId),
            'shoppingCart'      => \App\Models\Order\ShoppingCart::findOrFail($id),
            'doorHandlings2'    => \App\Models\Product\Door\DoorHandling::where([
                'door_id'       => $doorId,
                'handle_type'   => 1])->get(),
            'doorHandlings1'    => \App\Models\Product\Door\DoorHandling::where([
                'door_id'       => $doorId,

                'door_lock_color'   => \App\Models\Product\Door\Door::findOrFail($doorId),

                //'handle_type'   => 0])->get(),
            ])])
})->middleware('auth')
    ->name('shoppingcart.doortuning');*/


Route::get('/sc/product/{id}/{productId}', function ($id, $productId) {
    //$product =  \App\Models\Product::findOrFail($productId);
    //dd($product);

    return view('shoppingcart.itemtuning',
        ['product' => \App\Models\Product::findOrFail($productId),
            'shoppingCart' => \App\Models\Order\ShoppingCart::findOrFail($id)]);
})->middleware('auth')
    ->name('shoppingcart.itemtuning');


Route::get('/or', 'App\Http\Controllers\Cart\OrderController@showOrderRequests')
    ->middleware('auth')
    ->name('orview');
Route::get('/or/manuf', 'App\Http\Controllers\Cart\OrderController@showManufOrderRequests')
    ->middleware('auth')
    ->name('ormanufview');
Route::get('/or/delete/{orId}', function ($orId) {
    \App\Models\Order\OrderRequest::findOrFail($orId)->delete();
    return redirect()->route('oview');
    //return redirect()->route('orview');
})->middleware('permissions:d_order_request')
    ->name('ordelete');
Route::get('/or/submit/{orId}', 'App\Http\Controllers\Cart\OrderController@submitOrderRequest')
    ->middleware('auth')
    ->name('orsubmit');
Route::get('/or/confirm/{orId}', 'App\Http\Controllers\Cart\OrderController@confirmOrderRequest')
    ->middleware('auth')
    ->name('orconfirm');
Route::post('/or/finalize', '\App\Http\Controllers\Cart\OrderController@createOrderRequestStepTwo')
    ->middleware('auth')
    ->name('orcreatefinalize');
// for creation of order request
Route::post('/or/{cartId}', '\App\Http\Controllers\Cart\OrderController@createOrderRequestStepOne')
    ->middleware('auth')
    ->name('orcreatestepone');
Route::get('/or/{orId}', function ($orId) {
    $orderRequest = \App\Models\Order\OrderRequest::findOrFail($orId);
    $usStates = Constants::getStates();
    return view('orderrequest.steptwo', [
        'orderRequest'  => $orderRequest,
        'usStates'      => $usStates,
    ]);
})->middleware('auth')
    ->name('orviewsteptwo');
Route::post('/or/confirmstepone/{orId}', 'App\Http\Controllers\Cart\OrderController@confirmStepOne')
    ->middleware('auth')
    ->name('orconfirmstepone');
Route::get('/or/view/{orId}', function ($orId) {
    return view('orderrequest.viewone', ['orderRequest' => \App\Models\Order\OrderRequest::findOrFail($orId)]);
})->middleware('auth')
    ->name('orviewone');

Route::post('/o/convert/{orId}', 'App\Http\Controllers\Cart\OrderController@convertOrderRequest')
    ->middleware('auth')
    ->name('oconvert');
Route::get('/o/view/{oId}', function ($oId) {
    $order = \App\Models\Order\Order::findOrFail($oId);
    return view('order.view', ['order' => $order, 'status' => \App\Models\Order\Status::all()]);
})->middleware('auth')
    ->name('oviewone');

// oview route name
Route::get('/o', 'App\Http\Controllers\Cart\OrderController@showOrders')
    ->middleware('auth')
    ->name('oview');

Route::get('/o/orPrint/{oId}', 'App\Http\Controllers\Cart\OrderController@orPrint')
    ->middleware('auth')
    ->name('orprint');

Route::get('/o/orderDelete/{orId}', function ($orId) {
    // get the order_request_id
    //$order_detail = \App\Models\Order\Order::findOrFail($orId);

    //echo '<pre>';var_dump($door_items);echo '</pre>';
    \App\Models\Order\Order::findOrFail($orId)->delete();
    // delete from the order items too
    DB::table('order_items')->where('order_id', $orId)->delete();

    $door_items         = DB::table('door_items')->where('order_id', $orId)->first();
    $door_items_arr     = (array)$door_items;
    if( count( $door_items_arr )  >= 1 &&  array_key_exists('id', $door_items_arr) ){
        $door_items_id  = $door_items->id;
        DB::table('door_item_modifiers')->where('door_item_id', $door_items_id)->delete();
        DB::table('door_items')->where('order_id', $orId)->delete();
    }

    return redirect()->route('oview');
});

//    ->middleware('permissions:d_order_request')->name('ordelete');


Route::get('/o/editManufacturerform/{oId}', 'App\Http\Controllers\Cart\OrderController@editManufacturerform')
    ->middleware('auth');


Route::post('/o/manufacturerReqconfirm/', 'App\Http\Controllers\Cart\OrderController@manufacturerReqconfirm')
    ->middleware('auth');
Route::get('/o/editManufacturereqconfirm/{orId}', 'App\Http\Controllers\Cart\OrderController@editManufacturereqconfirm')
    ->middleware('auth');


Route::get('/o/orderReqconfirm/{orId}', 'App\Http\Controllers\Cart\OrderController@orderReqconfirm')
    ->middleware('auth');
Route::get('/o/rejectOrderrequest/{orId}', 'App\Http\Controllers\Cart\OrderController@rejectOrderrequest')
    ->middleware('auth');



Route::post('/o/Editmanufacturerreq/', '\App\Http\Controllers\Cart\OrderController@Editmanufacturerreq');
Route::get('/o/Editmanufacturerdetailview/{orId}', '\App\Http\Controllers\Cart\OrderController@Editmanufacturerdetailview');
Route::get('/o/Editmanufacturerdetailprint/{orId}', '\App\Http\Controllers\Cart\OrderController@Editmanufacturerdetailprint');
Route::get('/o/UpdateOrderRequest/{status}/{orReqId}', '\App\Http\Controllers\Cart\OrderController@UpdateOrderRequest');
Route::get('/o/Distributor_request_update/{status}/{orReqId}', '\App\Http\Controllers\Cart\OrderController@Distributor_request_update');






Route::get('/p/helper/door/{categoryName}', '\App\Http\Controllers\Product\Door\DoorHelperController@getDoorTypes')
    ->middleware('auth')
    ->name('productdoorhelper');

Route::get('edit/product/{id}', '\App\Http\Controllers\Product\ProductController@ProductEdit')->name('myproductedit');


Route::post('updateProduct', '\App\Http\Controllers\Product\ProductController@updateProduct')->name('updateProduct');



Route::get('/clear-cache', function() {
    //Artisan::call('route:clear');
    //Artisan::call('cache:clear');
    Artisan::call('view:clear');
    //Artisan::call('config:clear');
    return "Artisan cleared";
});


Route::get('/cache-clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    //Artisan::call('config:clear');
    return "Artisan Cache cleared";
});

Route::get('/route-clear', function() {

    Artisan::call('route:clear');

    //Artisan::call('config:clear');
    return "Artisan Route cleared";
});

Route::get('/route-cache', function() {

    Artisan::call('route:cache');

    //Artisan::call('config:clear');
    return "Artisan Route cleared";
});


Route::get('/view-clear', function() {

    Artisan::call('view:clear');

    //Artisan::call('config:clear');
    return "Artisan Route cleared";
});



Route::get('/clear-cache-uppp', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

//php artisan route:cache

//php artisan view:clear


Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return "Config Cache";
});

Route::get('/opt', function() {
    Artisan::call('optimize');
    return "optimized";
});

Route::get('/opt-clae', function() {
    Artisan::call('optimize:clear');
    return "optimized clear";
});

