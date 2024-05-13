<?php

namespace App\Http\Controllers\Product\Door;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerUtilities;
use App\Http\Controllers\The;
use App\Models\AddOnOption;
use App\Models\Category;
use App\Models\FinishOption;
use App\Models\Product;
use App\Models\Product\Door\AdditionalOption;
use App\Models\Product\Door\CustomOptionName;
use App\Models\Product\Door\Door;
use App\Models\Product\Door\DoorFrame;
use App\Models\Product\Door\DoorHandling;
use App\Models\Product\Door\DoorMeasurement;
use App\Models\Product\Door\DoorName;
use App\Models\Product\Door\DoorType;
use App\Models\Product\Door\InteriorColor;
use App\Models\Product\ImageDetails;
use App\Models\ProductSizeCode;
use Exception;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Type\Integer;
use function redirect;
use function request;
use function view;
use Illuminate\Http\Request;
use DB;

class DoorController extends Controller
{

    /**
     * @var ProductSizeCode[]|\Illuminate\Database\Eloquent\Collection
     */
    private $sizeCodes;
    private $SDLOPTIONS = [
        "1-Lite No Grid",
        "10-Lite SDL",
        "12-Lite SDL",
        "15-Lite SDL",
        "18-Lite SDL"];
    private $GBGOPTIONS = [
        //"1-Lite GBG",
        "10-Lite GBG",
        "12-Lite GBG",
        "15-Lite GBG",
        "18-Lite GBG",
    ];
    private $SDLGBGOPTIONS = [
        "1-Lite SDL+GBG",
        "10-Lite SDL+GBG",
        "12-Lite SDL+GBG",
        "15-Lite SDL+GBG",
        "18-Lite SDL+GBG",
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->sizeCodes = ProductSizeCode::all();
    }

    public function createDoorFlowStepOne()
    {
        $this->middleware('auth');

        return view('product.create.doorflow.stepone', [
            'categories'    => Category::all(),
            'doorTypes'     => DoorType::all(),
        ]);
    }

    public function createDoorFlowStepTwo($id)
    {
        $this->middleware('auth');
        $door = Door::findOrFail($id);

        $handlingCount = 0;
        foreach ($door->doorHandlings as $h) {
            $handlingCount++;
        }
        $frameCount = 0;
        foreach ($door->doorFrames as $f) {
            $frameCount++;
        }
        $colorCount = 0;
        foreach ($door->interiorColors as $c) {
            $colorCount++;
        }
        return view('product.create.doorflow.steptwo',
            ['door' => \App\Models\Product\Door\Door::findOrFail($id),
                'doorHandlingCount' => $handlingCount,
                'doorFrameCount' => $frameCount,
                'colorCount' => $colorCount,
            ]);
    }

    public function editDoorFlowStepOne($id)
    {
        $this->middleware('auth');

        $door                   = Door::findOrFail($id);
        $doorHandlingCount      = 0;
        $doorMeasurementCount   = 0;
        $colorCount             = 0;
        $doorFrameCount         = 0;

        foreach ($door->doorHandlings as $h) {
            $doorHandlingCount++;
        }
        foreach ($door->doorMeasurements as $m) {
            $doorMeasurementCount++;
        }
        foreach ($door->interiorColors as $c) {
            $colorCount++;
        }
        foreach ($door->doorFrames as $f) {
            $doorFrameCount++;
        }

        return view('product.edit.doorflow.stepone', [
            'door'                  => $door,
            'categories'            => Category::all(),
            'doorTypes'             => DoorType::all(),
            'doorHandlingCount'     => $doorHandlingCount,
            'doorMeasurementCount'  => $doorMeasurementCount,
            'colorCount'            => $colorCount,
            'doorFrameCount'        => $doorFrameCount,
        ]);
    }

    public function editDoorFlowStepTwo($id)
    {
        $this->middleware('auth');

        $door = Door::findOrFail($id);
        $doorFinishPrices = [];
        foreach ($door->interiorColors as $color) {

            foreach ($door->doorMeasurements as $dm) {
                $results = Product\Door\DoorFinishPrice::where('door_measurement_id', $dm->id)
                    ->where('interior_color_id', $color->id)->get();
                foreach ($results as $r) {
                    $doorFinishPrices[] = $r;
                }
            }

        }

        return view('product.edit.doorflow.steptwo', [
            'door' => $door,
            'doorFinishPrices' => $doorFinishPrices]);
    }


public function storeDoorFlowStepOne(Request $request)
    {
        //die('sadadd');

        $data = request()->all();
        //dd($data);


        $doorCategory       = $data['product_category'];
        $doorType           = $data['door_type'];
        $doorName           = $data['door_name'];
        $panelCount         = $data['panel_count'];
        $officialDoorType   = $this->getDoorType($doorType, $doorCategory);

        $main_image     = $request->file('main_image');


        if($main_image){
            $main_img_name =  $main_image->getClientOriginalName();
            $main_image->move(public_path('storage/product_image'), $main_img_name);
        }else{
            $main_img_name =  '';
        }

        $door               = Door::create([
                                'name'          => $doorName,
                                'door_type_id'  => $officialDoorType->id,
                                'category_id'   => $doorCategory,
                                'panel_count'   => $panelCount,
                                'main_image'    => $main_img_name,
                            ]);

        $doorNameTypes      = [];

        $optionalSpecifierCount = $data['optional_select_count'];
        $typeCount          = $data['type_count'];

        if ($optionalSpecifierCount > 0 && $data['additional_door_spec-0'] != '') {
            for ($i = 0; $i < $optionalSpecifierCount; $i++) {
                $optSpec = AdditionalOption::create([
                    'name' => $data['additional_door_spec-' . $i],
                    'group_name' => 'OPT_SPEC',
                    'price' => 0,
                    'is_per_panel' => 0,
                    'is_per_light' => 0,
                    'door_id' => $door->id,
                    'door_measurement_id' => -1,
                    'image_id' => -1,
                ]);
            }
        }

        $created_at =date('Y-m-d H:i:s');
        for ($i = 0; $i < $typeCount; $i++) {
            $doorName = $data['door_name_type-' . $i];
            $imageInfo = '';
//            if (isset($data['door_type_image-' . $i])) {
//                $imageInfo = $data['door_type_image-' . $i];
//            }
            //$image = $this->getImage($imageInfo);

            $file       = $request->file('door_type_image-' . $i);
            if(!empty($file->getClientOriginalName())){
                $kksad = $file->getClientOriginalName();
                
                
                
                $file->move(public_path('storage/product_image'), $kksad);
                $image = \DB::table('images')->insertGetId([
                        'image_path' => $kksad,
                        'created_at' => $created_at,
                        'updated_at' => $created_at,
                    ]);
    
                $doorNameTypes[$i] = DoorName::create([
                    'door_id' => $door->id,
                    'door_name_or_type' => $doorName,
                    'image_id' => $image,
                ]);
            }
        }

        return redirect()->route('pcreatedoorflowsteptwo',
            ['id' => $door->id]);
    }

    public function storeDoorFlowStepOne_bkkk()
    {
        //die('sadadd');

        $data = request()->all();
        //dd($data);

        $doorCategory       = $data['product_category'];
        $doorType           = $data['door_type'];
        $doorName           = $data['door_name'];
        $panelCount         = $data['panel_count'];
        $officialDoorType   = $this->getDoorType($doorType, $doorCategory);
        $door               = Door::create([
                                'name' => $doorName,
                                'door_type_id' => $officialDoorType->id,
                                'category_id' => $doorCategory,
                                'panel_count' => $panelCount
                            ]);

        $doorNameTypes      = [];

        $optionalSpecifierCount = $data['optional_select_count'];
        $typeCount          = $data['type_count'];

        if ($optionalSpecifierCount > 0 && $data['additional_door_spec-0'] != '') {
            for ($i = 0; $i < $optionalSpecifierCount; $i++) {
                $optSpec = AdditionalOption::create([
                    'name' => $data['additional_door_spec-' . $i],
                    'group_name' => 'OPT_SPEC',
                    'price' => 0,
                    'is_per_panel' => 0,
                    'is_per_light' => 0,
                    'door_id' => $door->id,
                    'door_measurement_id' => -1,
                    'image_id' => -1,
                ]);
            }
        }

        for ($i = 0; $i < $typeCount; $i++) {
            $doorName = $data['door_name_type-' . $i];
            $imageInfo = '';
            if (isset($data['door_type_image-' . $i])) {
                $imageInfo = $data['door_type_image-' . $i];
            }
            $image = $this->getImage($imageInfo);
            $doorNameTypes[$i] = DoorName::create([
                'door_id' => $door->id,
                'door_name_or_type' => $doorName,
                'image_id' => $image->id,
            ]);
        }

        return redirect()->route('pcreatedoorflowsteptwo',
            ['id' => $door->id]);
    }

    public function storeDoorFlowStepTwo()
    {
        $data = request()->all();

        $door = Door::findOrFail($data['door_id']);
        $sizeCount = $data['size_count'];
        $colorCount = $data['color_count'];

        if (!$door->isGliding()) {
            $doorHandlingCount = $data['door_handling_count'];
            $frameOptionCount = $data['frame_option_count'];
        }

        $measurements = [];
        $doorHandlings = [];
        $colors = [];
        $frameOptions = [];
        for ($i = 0; $i < $sizeCount; $i++) {
            $measurements[$i] = Product\Door\DoorMeasurement::create([
                'height' => $data['height-' . $i],
                'width' => $data['width-' . $i],
                'door_id' => $door->id,
            ]);
        }

        for ($i = 0; $i < $colorCount; $i++) {
            $colors[$i] = Product\Door\InteriorColor::create([
                'color' => $data['color-' . $i],
                'door_id' => $door->id,
            ]);
        }

        if (!$door->isGliding()) {
            for ($i = 0; $i < $doorHandlingCount; $i++) {
                $doorHandlings[$i] = Product\Door\DoorHandling::create([
                    'handling' => $data['doorhandling-' . $i],
                    'door_id' => $door->id,
                ]);
            }

            for ($i = 0; $i < $frameOptionCount; $i++) {
                $frameOptions = Product\Door\DoorFrame::create([
                    'frame' => $data['frame-' . $i],
                    'door_id' => $door->id,
                ]);
            }
        }
        return redirect()->route('pcreatedoorflowstepthree',
            ['id' => $door->id]);
    }

    public function storeDoorFlowStepThree()
    {
        $data = request()->all();
        $door = Door::findOrFail($data['door_id']);
        $prices = [];
        foreach ($door->interiorColors as $ic) {
            foreach ($door->doorMeasurements as $m) {
                $price = -1;
                if (!isset($data['is_na-' . $ic->id . $m->id])) {
                    $price = $data['sizePrice-' . $ic->id . $m->id];
                }
                $price =
                    Product\Door\DoorFinishPrice::create([
                        'door_measurement_id' => $m->id,
                        'interior_color_id' => $ic->id,
                        'price' => $price,
                    ]);
                $prices[$m->id . $ic->id] = $price;
            }
        }

        return redirect()->route('pcreatedoorflowstepfour',
            ['id' => $door->id]);
    }

    public function storeDoorFlowStepFour()
    {
        $data = request()->all();
//        dd($data);
        $door = Door::findOrFail($data['door_id']);

        $frame_thickness_count = $data['frame_thickness_count'];
        $lock_set_count = $data['lock_set_count'];
        $handle_type_count = $data['handle_type_count'];
        $glass_depth_count = $data['glass_depth_count'];
        $glass_option_count = $data['glass_option_count'];
        $custom_glass_option_count = $data['custom_glass_option_count'];
        $isCustom = 0;
        $hasPrice = false;

        foreach ($door->doorMeasurements as $m) {
            $hasPrice = false;
            for ($i = 0; $i < $glass_option_count; $i++) {
                $image = '';
                if (isset($data['glass_option_image-' . $i])) {
                    $imageData = $data['glass_option_image-' . $i];
                    $image = ControllerUtilities::storeImage($imageData);
                }
                if (isset($data['glass_option_has_prices']))
                    $hasPrice = true;
                $this->createOption("GLASS_OPTION", $data['glass_option-' . $i], $door->id, $m->id, $image, $isCustom, $hasPrice, 0);
            }
            for ($i = 0; $i < $glass_depth_count; $i++) {
                $image = '';
                if (isset($data['glass_depth_option_image-' . $i])) {
                    $imageData = $data['glass_depth_option_image-' . $i];
                    $image = ControllerUtilities::storeImage($imageData);
                }
                if (isset($data['glassDepthHasPrices']))
                    $hasPrice = true;
                $this->createOption("GLASS_DEPTH_OPTION", $data['glass_depth_option-' . $i], $door->id, $m->id, $image, $isCustom, $hasPrice, 0);
            }
            for ($i = 0; $i < $handle_type_count; $i++) {
                $image = '';
                if (isset($data['handle_type_option_image-' . $i])) {
                    $imageData = $data['handle_type_option_image-' . $i];
                    $image = ControllerUtilities::storeImage($imageData);
                }

                $this->createOption("HANDLE_TYPE_OPTION", $data['handle_type_option-' . $i], $door->id, $m->id, $image, $isCustom, $hasPrice, 0);
            }
            for ($i = 0; $i < $lock_set_count; $i++) {
                $image = '';
                if (isset($data['lock_set_option_image-' . $i])) {
                    $imageData = $data['lock_set_option_image-' . $i];
                    $image = ControllerUtilities::storeImage($imageData);
                }

                $this->createOption("LOCK_SET_OPTION", $data['lock_set_option-' . $i], $door->id, $m->id, $image, $isCustom, $hasPrice, 0);
            }

            for ($i = 0; $i < $frame_thickness_count; $i++) {
                $image = '';
                if (isset($data['frame_thickness_option_image-' . $i])) {
                    $imageData = $data['frame_thickness_option_image-' . $i];
                    $image = ControllerUtilities::storeImage($imageData);
                }
                if (isset($data['frameThicknessHasPrices']))
                    $hasPrice = true;
                $this->createOption("FRAME_THICKNESS_OPTION", $data['frame_thickness_option-' . $i], $door->id, $m->id, $image, $isCustom, $hasPrice, 0);
            }


        }

        // Iterate custom options, and create a value for each size.
        for ($i = 0; $i < $custom_glass_option_count; $i++) {
            $numberOfValues = $data['custom_glass_option_values_count-' . $i];
            $hasPrice = false;
            if (isset($data['custom_glass_option_has_prices_' . $i]))
                $hasPrice = true;
            $customOptionName = $data['custom_glass_option_name-' . $i];
            $customOption = $this->createCustomOption($customOptionName, $door->id, $hasPrice, 0);
            foreach ($door->doorMeasurements as $m) {
                for ($v = 0; $v < $numberOfValues; $v++) {
                    if(isset($data['custom_glass_option-' . $i . '_value-' . $v])){
                        $optionValue = $data['custom_glass_option-' . $i . '_value-' . $v];
                        $this->createOption($customOptionName, $optionValue, $door->id, $m->id, $image, $customOption->id, $hasPrice, 0);
                    }
                }
            }
        }

        return redirect()->route('pcreatedoorflowstepfive',
            ['id' => $door->id]);
    }

    public function storeDoorFlowStepFive()
    {
        $data = request()->all();
        $door = Door::findOrFail($data['door_id']);

        $sdlIndividualPrices = true;
        $gbgIndividualPrices = true;

        if (isset($data['sdl_all_same_price']) &&
            $data['sdl_all_same_price'] == 1) {
            $sdlIndividualPrices = false;
        }
        if (isset($data['gbg_all_same_price']) &&
            $data['gbg_all_same_price'] == 1) {
            $sdlIndividualPrices = false;
        }

        foreach ($door->doorMeasurements as $m) {
            $price = doubleval(-1);
            $isNA = false;
            if (isset($data['sdl_is_na-' . $m->id])) {
                $isNA = true;
            }
            if ($sdlIndividualPrices && isset($data['sdl_option_price-' . $m->id])) {
                if (!$isNA) {
                    $price = doubleval($data['sdl_option_price-' . $m->id]);
                }
            } else {
                if (isset($data['sdl_options_price'])) {
                    $price = doubleval($data['sdl_options_price']);
                }
            }
            $isPerPanel = true;
            $isPerLight = true;

            if (!$isNA)
                $this->updateSDLPrices($price, $m, $door);

            $price = -1;
            $isNA = false;
            if (isset($data['gbg_is_na-' . $m->id])) {
                $isNA = true;
            }
            if ($gbgIndividualPrices && isset($data['gbg_option_price-' . $m->id])) {
                if (!$isNA) {
                    $price = doubleval($data['gbg_option_price-' . $m->id]);
                }
            } else {
                if (isset($data['gbg_options_price'])) {
                    $price = doubleval($data['gbg_options_price']);
                }
            }
            $isPerPanel = true;
            $isPerLight = true;


            if (!$isNA)
                $this->updateGBGPrices($price, $m, $door);

        }

        foreach ($door->additionalOptions as $additionalOption) {
            if ($additionalOption->group_name == 'GLASS_OPTION') {

            } else if ($additionalOption->group_name == 'GLASS_LOWE_OPTION') {

            } else if ($additionalOption->group_name == 'GLASS_DEPTH_OPTION') {

            } else if ($additionalOption->group_name == 'HANDLE_TYPE_OPTION') {
                if (isset($data['handle_type_price-' . $additionalOption->id])
                    || isset($data['handle_type_is_na-' . $additionalOption->id])) {
                    $isPerPanel = false;
                    $isPerLight = false;
                    $isNA = false;
                    if (isset($data['handle_type_is_per_light-' . $additionalOption->id])) {
                        $isPerLight = true;
                    }
                    if (isset($data['handle_type_is_per_panel-' . $additionalOption->id])) {
                        $isPerPanel = true;
                    }
                    if (isset($data['handle_type_is_na-' . $additionalOption->id])) {
                        $isNA = true;
                    }
                    $price = -1;
                    if (!$isNA) {
                        $price = $data['handle_type_price-' . $additionalOption->id];
                    }

                    $this->updateOptionPrice($isPerLight, $isPerPanel, $price, $additionalOption);
                }
            } else if ($additionalOption->group_name == 'LOCK_SET_OPTION') {
                if (isset($data['lock_set_price-' . $additionalOption->id])
                    || isset($data['lock_set_is_na-' . $additionalOption->id])) {
                    $isNA = false;
                    if (isset($data['lock_set_is_na-' . $additionalOption->id])) {
                        $isNA = true;
                    }
                    $price = -1;
                    if (!$isNA) {
                        $price = $data['lock_set_price-' . $additionalOption->id];
                    }

                    $this->updateOptionPrice(false, false, $price, $additionalOption);
                }

            } else if ($additionalOption->group_name == 'FRAME_THICKNESS_OPTION') {

            } else {
                if ($additionalOption->is_custom_option && $additionalOption->has_price) {
                    if (isset($data['custom_option_price-' . $additionalOption->id])) {
                        $price = $data['custom_option_price-' . $additionalOption->id];
                        $this->updateOptionPrice(false, false, $price, $additionalOption);
                    }
                }
            }
        }

        return redirect()->route('pview', [
            'products' => \App\Models\Product::all()]);
    }

    public function updateDoorFlowStepOne(Request $request)
    {
        $data = request()->all();
        //dd($data);
        $door       = Door::findOrFail($request->door_id);
        $isgliding  = false;
        if (isset($door->category) && str_contains($door->category->category_name, 'Gliding')) {
            $isgliding = true;
        }


        //if update door_names following fields but we are ipdating onl image here
        //door_name_id
        //door_name_type_id

        // main image upload

        $main_image     = $request->file('main_image');
        $old_img_names  = '';

        if(array_key_exists('old_main_image',$data) && isset($data['old_main_image'])){
            $old_img_names = $data['old_main_image'];
        }

        if($main_image){
            $main_img_name =  $main_image->getClientOriginalName();
            $main_image->move(public_path('storage/product_image'), $main_img_name);
        }else{
            $main_img_name = $old_img_names;
        }


        $productCategory    = $request->product_category;
        $doorType           = $request->door_type;
        $doorName           = $request->door_name;
        $panelCount         = $request->panel_count;
        $typeCount          = $request->type_count;
        $measurementCount   = $request->door_measurement_count;
        $colorCount         = $request->color_count;
        $frameCount         = 0;
        $handlingCount      = 0;
        if (!$isgliding) {
            $frameCount     = $request->frame_option_count;
            $handlingCount  = $request->door_handling_count;
        }

        $door->update([
            'name'          => $doorName,
            'door_type_id'  => $doorType,
            'category_id'   => $productCategory,
            'panel_count'   => $panelCount,
            'main_image'   => $main_img_name,

        ]);

        if ($typeCount > 0) {
            //$this->updateDoorTypes($door, $data, $typeCount);
            //$this->updateDoorTypes($door, $request, $typeCount);

            for ($i = 0; $i < $typeCount; $i++) {

                $old_img_id = $data['old_image_id-' . $i];
                $file       = $request->file('door_type_image-' . $i);


                $door_nm_tp = $data['door_name_type-' . $i];
                $door_nm_id = $data['door_name_id-' . $i];




                if ($file) {
                    $kksad = $file->getClientOriginalName();
                    $file->move(public_path('storage/product_image'), $kksad);
                    DB::connection()->enableQueryLog();
                    \DB::table('images')->where('id', $old_img_id)->update(['image_path' => $kksad ]);

                    //$queries = DB::getQueryLog();$last_query = end($queries);//dd($last_query);

                } else {
                    $kksad          = $data['old_image_name-' . $i];
                    //$dss            = explode('/', $old_image_name);$kksad          = $dss[1];
                    DB::table('images')->where('id', $old_img_id)->update(['image_path' => $kksad  ]);
                }

                DB::table('door_names')->where('id', $door_nm_id)->update(['door_name_or_type' => $door_nm_tp  ]);
            }
        }

        if (!$isgliding) {
            if ($handlingCount > 0) {
                $this->updateHandlings($door, $data, $handlingCount);
                //$this->updateHandlings($door, $request, $handlingCount);
            }
        }
        if ($measurementCount > 0) {
            $this->updateMeasurements($door, $data, $measurementCount);
            //$this->updateMeasurements($door, $request, $measurementCount);
        }
        if ($colorCount > 0) {
            $this->updateColors($door, $data, $colorCount);
            //$this->updateColors($door, $request, $colorCount);
        }
        if (!$isgliding) {
            if ($frameCount > 0) {
                $this->updateFrames($door, $data, $frameCount);
                //$this->updateFrames($door, $request, $frameCount);
            }
        }





        return redirect()->route('peditdoorflowsteptwo', ['id' => $door->id]);
    }

    public function updateDoorFlowStepTwo()
    {
        $data = request()->all();
        $door = Door::findOrFail($data['door_id']);

        foreach ($door->interiorColors as $c) {
            foreach ($door->doorMeasurements as $dm) {
                if (isset($data['finish_price-' . $dm->id . '-' . $c->id])) {
                    $results = Product\Door\DoorFinishPrice::where('door_measurement_id', $dm->id)
                        ->where('interior_color_id', $c->id)->get();
                    if (isset($results[0])) {
                        $results[0]->update([
                            'price' => $data['finish_price-' . $dm->id . '-' . $c->id]
                        ]);
                    } else {
                        Product\Door\DoorFinishPrice::create([
                            'door_measurement_id' => $dm->id,
                            'interior_color_id' => $c->id,
                            'price' => $data['finish_price-' . $dm->id . '-' . $c->id],
                        ]);
                    }
                }
            }
        }

        return redirect()->route('peditdoorflowstepthree', ['id' => $door->id]);

    }

    public function updateDoorFlowStepThree()
    {

        $data               = request()->all();
        $door               = Door::findOrFail($data['door_id']);

        //dd($data['sdl_option_price-1009']);
        $hiddenIdList       = explode(',', $data['hidden_id_list']);
        $hiddenListSi       = sizeof($hiddenIdList);
        $data_arra          = $data['arr_vale'];
        $arr_vale           = sizeof($data_arra);
        //$dsfs             = $data_arra[0];//dd($data['sdl_is_na'][0]);


        //$sdl_option_pr = $data['sdl_option_price'];

        // checked or not
//        $sdl_is_na_arr = $data['sdl_is_na'];
//        $con_sld_na_ar = sizeof($sdl_is_na_arr);
        //echo $arr_vale;die;
        //echo $data['sdl_option_price'][317];die;

        //if($con_sld_na_ar >=1){
        if($arr_vale>=1){
            for ($i = 0; $i < $arr_vale; $i++) {

                //$sdl_is_na = array_key_exists($sdl_is_na_arr[$i]) ? $sdl_is_na_arr[$i] : 0;
                $sdl_is_na = isset($sdl_is_na_arr[$i]) ? $sdl_is_na_arr[$i] : 0;

                $optionId   = $data_arra[$i];
                $avail      = $sdl_is_na;

                //echo $combo      =  'KeyIndex-->'. $i.' ==='.  'OptionId-->'. $optionId.' ==disabled--->'. $avail .' ==Price--->'. $data['sdl_option_price'][$i] ;

                $option     = AdditionalOption::find($optionId);


                if(!empty($option->id)){
                    $option->update([
                        //'price'     => $data['sdl_option_price-'.$optionId],
                        'price'     => $data['sdl_option_price'][$i],
                        'disabled'  => $avail
                    ]);
                }
            }
        }
            // all are available
      /*  }else{
            for ($i = 0; $i < $arr_vale; $i++) {
                $optionId = $data_arra[$i];
                $option = AdditionalOption::find($optionId);
                if (!empty($option->id)) {
                    $option->update([
                        'price' => $data['sdl_option_price-' . $optionId],
                    ]);
                }
            }
        }*/

        //for ($i = 0; $i < $hiddenListSi; $i++) {
        return redirect()->route('pview');
    }

    /**
     * Delete a door and associated records.
     *
     * @param $doorId - the Door to delete.
     */
    public function deleteDoor($doorId)
    {

        $door = Door::find($doorId);
        if($door != null){
            if(!empty($door->doorNames())){
                foreach ($door->doorNames() as $it) {
                    $it->delete();
                }
            }
            if(!empty($door->doorFrames())){
                foreach ($door->doorFrames() as $it) {
                    $it->delete();
                }
            }
            if(!empty($door->doorHandlings())){
                foreach ($door->doorHandlings() as $it) {
                    $it->delete();
                }
            }
            if(!empty($door->doorMeasurements())){
                foreach ($door->doorMeasurements() as $it) {
                    $it->delete();
                }
            }
            if(!empty($door->interiorColors())){
                foreach ($door->interiorColors() as $it) {
                    $it->delete();
                }
            }
            if(!empty($door->additionalOptions())){
                foreach ($door->additionalOptions() as $it) {
                    $it->delete();
                }
            }

            $door->delete();
        }
        $product = Product::find($doorId);
        if($product != null){
            $product->delete();
        }

        return redirect('/p');
    }

    /**
     * If there is a path, save the image and return the object, otherwise
     * return the coming soon image.
     *
     * @param $path - Image path
     * @return Product\ImageDetails
     */
    private function getImage($path): Product\ImageDetails
    {
        $image = '';

        if ($path && $path != '') {
            $image = ControllerUtilities::storeImage($path);
        }
        if ($image == '') {
            $image = ImageDetails::findOrFail(1);
        }

        return $image;
    }

    private function createCustomOption($customOptionName, $doorId, bool $hasPrice, $price): CustomOptionName
    {
        return CustomOptionName::create([
            'door_id' => $doorId,
            'option_name' => $customOptionName,
            'price' => $price,
            'has_price' => $hasPrice,
        ]);
    }

    private function createOption(string $groupName, string $optionName, int $doorId, int $measurementId, $image, $isCustomOption, $hasPrice, $price)
    {
        $imageId = -1;
        if (isset($image) && $image != '') {
            $imageId = $image->id;
        }
        Product\Door\AdditionalOption::create([
            'door_id' => $doorId,
            'name' => $optionName,
            'group_name' => $groupName,
            'price' => $price,
            'is_per_panel' => false,
            'is_per_light' => false,
            'door_measurement_id' => $measurementId,
            'image_id' => $imageId,
            'has_price' => $hasPrice,
            'is_custom_option' => $isCustomOption,
        ]);
    }

    private function updateOptionPrice(bool $isPerLight, bool $isPerPanel, $price, $additionalOption)
    {
        $additionalOption->update([
            'is_per_panel' => $isPerPanel,
            'is_per_light' => $isPerLight,
            'price' => $price,
        ]);
    }

    private function updateSDLPrices($price, Product\Door\DoorMeasurement $m, Door $door)
    {
        $multiplier = 1;
        foreach ($this->SDLOPTIONS as $sdl) {
            try {
                $nameArray = explode("-", $sdl);
                $multiplier = intval($nameArray[0]);
            } catch (\Exception $exception) {
                Log::error("Error setting up multiplier for GbG", $exception);
            }
            Product\Door\AdditionalOption::create([
                'door_id' => $door->id,
                'name' => $sdl,
                'group_name' => 'GLASS_GRID',
                'price' => $price,
                'is_per_panel' => false,
                'is_per_light' => true,
                'door_measurement_id' => $m->id,
                'image_id' => -1,
                'multiplier' => $multiplier,
            ]);
        }
    }

    private function updateGBGPrices($price, Product\Door\DoorMeasurement $m, Door $door)
    {
        $multiplier = 1;
        foreach ($this->GBGOPTIONS as $gbg) {

            Product\Door\AdditionalOption::create([
                'door_id' => $door->id,
                'name' => $gbg,
                'group_name' => 'GLASS_GRID',
                'price' => $price,
                'is_per_panel' => false,
                'is_per_light' => true,
                'door_measurement_id' => $m->id,
                'image_id' => -1,
                'multiplier' => $multiplier,
            ]);
        }
    }

    private function updateSDLGBGPrices(double $price, Product\Door\DoorMeasurement $m, Door $door)
    {
        foreach ($this->SDLGBGOPTIONS as $both) {
            Product\Door\AdditionalOption::create([
                'door_id' => $door->id,
                'name' => $both,
                'group_name' => 'GLASS_GRID',
                'price' => $price,
                'is_per_panel' => false,
                'is_per_light' => true,
                'door_measurement_id' => $m->id,
                'image_id' => -1,
            ]);
        }
    }

    private function updateDoorTypes(Door $door, array $data, int $typeCount)
    {
        for ($i = 0; $i < $typeCount; $i++) {
            $doorNameType = '';
            if (isset($data['door_name_type_id-' . $i])) {
                $doorNameType = DoorName::find($data['door_name_type_id-' . $i]);
                $doorNameType->update([
                    'door_name_or_type' => $data['door_name_type-' . $i],
                ]);
            } else {
                $doorNameType = DoorName::create([
                    'door_id' => $door->id,
                    'door_name_or_type' => $data['door_name_type-' . $i],
                    'image_id' => 1,
                ]);
            }

            if (isset($data['door_type_image-' . $i])) {
                $imageInfo = $data['door_type_image-' . $i];
                $image = $this->getImage($imageInfo);
                $doorNameType->update(['image_id' => $image->id]);
            }
        }
    }

    private function updateHandlings($door, array $data, $handlingCount)
    {
        for ($i = 0; $i < $handlingCount; $i++) {
            if (isset($data['doorhandling_id-' . $i])) {
                $doorNameType = DoorHandling::find($data['doorhandling_id-' . $i]);
                $doorNameType->update([
                    'handling' => $data['doorhandling-' . $i],
                ]);
            } else {
                DoorHandling::create([
                    'door_id' => $door->id,
                    'handling' => $data['doorhandling-' . $i],
                ]);
            }
        }
    }

    private function updateMeasurements($door, array $data, $measurementCount)
    {
        for ($i = 0; $i < $measurementCount; $i++) {
            if (isset($data['measurement_id-' . $i])) {
                $doorNameType = DoorMeasurement::find($data['measurement_id-' . $i]);
                $doorNameType->update([
                    'height' => $data['height-' . $i],
                    'width' => $data['width-' . $i],
                ]);
            } else {
                DoorMeasurement::create([
                    'height' => $data['height-' . $i],
                    'width' => $data['width-' . $i],
                    'door_id' => $door->id,
                ]);
            }
        }
    }

    private function updateColors($door, array $data, $colorCount)
    {
        for ($i = 0; $i < $colorCount; $i++) {
            if (isset($data['color_id-' . $i])) {
                $doorNameType = InteriorColor::find($data['color_id-' . $i]);
                $doorNameType->update([
                    'color' => $data['color-' . $i],
                ]);
            } else {
                InteriorColor::create([
                    'color' => $data['color-' . $i],
                    'door_id' => $door->id,
                ]);
            }
        }
    }

    private function updateFrames($door, array $data, $frameCount)
    {
        for ($i = 0; $i < $frameCount; $i++) {
            if (isset($data['door_frame_option_id-' . $i])) {
                $doorNameType = DoorFrame::find($data['door_frame_option_id-' . $i]);
                $doorNameType->update([
                    'frame' => $data['frame-' . $i]
                ]);
            } else {
                DoorFrame::create([
                    'frame' => $data['frame-' . $i],
                    'door_id' => $door->id,
                ]);
            }
        }
    }

    private function getDoorType($doorType, $categoryId): DoorType
    {
        $doorTypes = DoorType::where('door_type_pretty_name', $doorType)->where('category_id', $categoryId)->get();

        if ($doorTypes != null && $doorTypes->first() != null) {
            return $doorTypes->first();
        }

        $door_type_string = '';
        if ($categoryId == 3) {
            $door_type_string = 'gliding';
        } else if ($categoryId == 2) {
            $door_type_string = 'hinged';
        } else {
            $cat = Category::find($categoryId);
            $door_type_string = $cat->category_name;
        }

        return DoorType::create([
            'door_type' => $door_type_string,
            'door_type_pretty_name' => $doorType,
            'category_id' => $categoryId,
        ]);
    }


    public function updateDoorFlowStepOne_BKKK()
    {
        $data = request()->all();
        $door = Door::findOrFail($data['door_id']);
        $isgliding = false;
        if (isset($door->category) && str_contains($door->category->category_name, 'Gliding')) {
            $isgliding = true;
        }


        //if update door_names following fields but we are ipdating onl image here
        //door_name_id
        //door_name_type_id

        $old_image              = $data['old_image_id'];
        $count                  = count ($old_image);
        //images array
        //$files                  = $data->file('door_type_image');
        $allowedfileExtension   = ['pdf','jpg','png','jpeg'];

        //$data              = $data['door_type_image'];

        //$file = $data['door_type_image0'];

        for ($i = 0 ; $i < $count; $i++){
            //echo $old_image[$i].'<br>';


            //$file       = $files[$i];

            //dd($file);
            //$imageName  = time().'_'.$file->getClientOriginalName();
            $file       = $data['door_type_image'.$i];
            //https://www.itsolutionstuff.com/post/laravel-8-image-upload-tutorial-exampleexample.html
            if(!empty($file->getClientOriginalName())){
                //$extension  = $file->getClientOriginalExtension();
                //$check      = in_array($extension,$allowedfileExtension);
                // move new image run the update and delete older image
                echo $imageName  = time().'_'.$file->getClientOriginalName();
                echo '<hr>';
                //$data->image->move(public_path('storage/product_image'), $imageName);

//                $door->update([
//                    'name' => $doorName,
//                    'door_type_id' => $doorType,
//                    'category_id' => $productCategory,
//                    'panel_count' => $panelCount,
//                ]);
            }


        }
//die;
        $productCategory = $data['product_category'];
        $doorType = $data['door_type'];
        $doorName = $data['door_name'];
        $panelCount = $data['panel_count'];
        $typeCount = $data['type_count'];
        $measurementCount = $data['door_measurement_count'];
        $colorCount = $data['color_count'];
        $frameCount = 0;
        $handlingCount = 0;
        if (!$isgliding) {
            $frameCount = $data['frame_option_count'];
            $handlingCount = $data['door_handling_count'];
        }

        $door->update([
            'name' => $doorName,
            'door_type_id' => $doorType,
            'category_id' => $productCategory,
            'panel_count' => $panelCount,
        ]);

        if ($typeCount > 0) {
            $this->updateDoorTypes($door, $data, $typeCount);
        }
        if (!$isgliding) {
            if ($handlingCount > 0) {
                $this->updateHandlings($door, $data, $handlingCount);
            }
        }
        if ($measurementCount > 0) {
            $this->updateMeasurements($door, $data, $measurementCount);
        }
        if ($colorCount > 0) {
            $this->updateColors($door, $data, $colorCount);
        }
        if (!$isgliding) {
            if ($frameCount > 0) {
                $this->updateFrames($door, $data, $frameCount);
            }
        }





        return redirect()->route('peditdoorflowsteptwo', ['id' => $door->id]);
    }


    public function updateSortDoor(Request $request)
    {
        echo $doorId     = $request->idd;

        echo $sortOrder  = $request->sort_order;
        echo '<br>';
        $door       = Door::findOrFail($doorId);

        $door->update([
            'id'            => $doorId,
            'sort_order'    => $sortOrder,
        ]);
    }
}
