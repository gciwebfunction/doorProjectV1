<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerUtilities;
use App\Models\AddOnOption;
use App\Models\FinishOption;
use App\Models\Product;
use App\Models\ProductSizeCode;

class OptionController extends Controller
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
     * Store an addon
     *
     * TODO NO VALIDATION! Maybe JS validation in the meantime?
     */
    public function storeNewAddOnOption($productId)
    {
        $product = Product::find($productId);
        $responseArray = [];
        $image = '';

        $uploaded = request('addOnOptionImage');

        if ($uploaded) {
            $image = ControllerUtilities::storeImage($uploaded);
        } else {
            $image = Product\ImageDetails::findOrFail(1);
        }

        $data = request()->all();
        $data = $this->updateCheckBoxFields($data);
        $responseArray['addOnOptionCount'] = $data['addOnOptionSizePriceCount'];
        $addOn = $this->findOrCreateAddOnOption($data, $product, $image);
        $responseObjectCount = 0;

        for ($addOnIndex = 0; $addOnIndex < $data['addOnOptionSizePriceCount']; $addOnIndex++) {
            $parsedSizesArray = $this->parseSizesFromUserInput($data['addOnOptionSizeCode' . $addOnIndex]);
            for ($optionCount = 0; $optionCount < sizeof($parsedSizesArray); $optionCount++) {
                $sizeCode = ProductSizeCodeUtility::getSizeCode($parsedSizesArray[$optionCount]);
                $addOn->productSizeCodes()->attach($sizeCode,
                    [
                        'add_on_option_price' => $data['addOnOptionPrice' . $addOnIndex],
                        'product_id' => $productId
                    ]);

                $responseArray['addOnOptionId' . $responseObjectCount] = $addOn->id;
                $responseArray['addOnOption' . $responseObjectCount] = $addOn;
                $responseArray['addOnOptionImage' . $responseObjectCount] = $image;
                $responseArray['addOnOptionSize' . $responseObjectCount] = $sizeCode->product_size_code;
                $responseArray['addOnOptionPrice' . $responseObjectCount] = $data['addOnOptionPrice' . $addOnIndex];

                $responseObjectCount++;
            }
        }

        return response()->json($responseArray);
    }

    /**
     * Store finish option
     *
     * TODO NO VALIDATION! Maybe JS validation in the meantime?
     */
    public function storeNewFinishOption($productId)
    {
        $product = Product::find($productId);
        $responseArray = [];
        $data = request()->all();
        $responseArray['finishOptionCount'] = $data['finishOptionSizePriceCount'];

        $finish = $this->findOrCreateFinishOption($data, $product);

        $image = '';
        $uploaded = request('finishOptionImage');
        if ($uploaded) {
            $image = ControllerUtilities::storeImage($uploaded);
        } else {
            $image = Product\ImageDetails::findOrFail(1);
        }

        $finish->images()->attach($image);
        $responseObjectCount = 0;

        for ($finishIndex = 0; $finishIndex < $data['finishOptionSizePriceCount']; $finishIndex++) {
            $parsedSizesArray = $this->parseSizesFromUserInput($data['finishOptionSizeCode' . $finishIndex]);

            for ($finishCount = 0; $finishCount < sizeof($parsedSizesArray); $finishCount++) {
                $sizeCode = ProductSizeCodeUtility::getSizeCode($parsedSizesArray[$finishCount]);
                $finish->productSizeCodes()->attach(
                    $sizeCode,
                    [
                        'finish_option_price' => $data['finishOptionPrice' . $finishIndex],
                        'product_id' => $productId
                    ]);

                $responseArray['finishOptionId' . $responseObjectCount] = $finish->id;
                $responseArray['finishOption' . $responseObjectCount] = $finish;
                $responseArray['finishOptionImage' . $responseObjectCount] = $image;
                $responseArray['finishOptionSize' . $responseObjectCount] = $sizeCode->product_size_code;
                $responseArray['finishOptionPrice' . $responseObjectCount] = $data['finishOptionPrice' . $finishIndex];

                $responseObjectCount++;
            }
        }

        return response()->json($responseArray);
    }

    public function deleteAddOnOptionSizeCode($addOnOptionId, $sizeCodeId)
    {
        $addOnOption = AddOnOption::findOrFail($addOnOptionId);
        $addOnOption->productSizeCodes()->detach($sizeCodeId);
    }

    public function deleteFinishOptionSizeCode($finishOptionId, $sizeCodeId)
    {
        $finishOption = FinishOption::findOrFail($finishOptionId);
        $finishOption->productSizeCodes()->detach($sizeCodeId);
    }

    public function deleteDoorOption($additionalOptionId)
    {
        Product\Door\AdditionalOption::findOrFail($additionalOptionId)->delete();
    }

    public function deleteDoorHandling($doorHandlingOptionId)
    {
        Product\Door\DoorHandling::findOrFail($doorHandlingOptionId)->delete();
    }

    public function deleteInteriorColor($interiorColorId)
    {
        Product\Door\InteriorColor::findOrFail($interiorColorId)->delete();
    }

    public function deleteDoorMeasurement($measurementId)
    {
        Product\Door\DoorMeasurement::findOrFail($measurementId)->delete();
    }

    private function updateCheckBoxFields(array $data): array
    {
        if (!array_key_exists('addOnOptionIsPerLight', $data)) {
            $data['addOnOptionIsPerLight'] = 0;
        } else if ($data['addOnOptionIsPerLight'] == 'on') {
            $data['addOnOptionIsPerLight'] = 1;
        }
        if (!array_key_exists('addOnOptionIsPerPanel', $data)) {
            $data['addOnOptionIsPerPanel'] = 0;
        } else if ($data['addOnOptionIsPerPanel'] == 'on') {
            $data['addOnOptionIsPerPanel'] = 1;
        }
        if (!array_key_exists('addOnOptionIsPriceSameAllSizes', $data)) {
            $data['addOnOptionIsPriceSameAllSizes'] = 0;
        } else if ($data['addOnOptionIsPriceSameAllSizes'] == 'on') {
            $data['addOnOptionIsPriceSameAllSizes'] = 1;
        }

        return $data;
    }

    /**
     * Test user input of a size code - 5068 vs. 5068(611)
     * If it is the latter, return two size codes for storage.
     * @param $sizeCodeString
     * @return array
     */
    private function parseSizesFromUserInput($sizeCodeString): array
    {
        $sizesArray = [];
        if (str_contains($sizeCodeString, '(')) {
            $strings = explode('(', $sizeCodeString);
            $sizesArray[0] = $strings[0];
            $sizesArray[1] = explode(')', $strings[1])[0];
            $stringArr = str_split($sizesArray[0]);
            if (strlen($sizesArray[0]) == 4) {
                $sizesArray[1] = $stringArr[0] . $stringArr[1] . $sizesArray[1];
            } else if (strlen($sizesArray[0]) == 5) {
                $sizesArray[1] = $stringArr[0] . $stringArr[1] . $stringArr[2] . $sizesArray[1];
            }

        } else {
            $sizesArray[0] = $sizeCodeString;
        }

        return $sizesArray;
    }

    /**
     * Get the finish option, if it is not in the database, create it.
     *
     * Attach the finish option to the product.
     *
     * @param array $data
     * @param $product
     * @return FinishOption
     */
    private function findOrCreateFinishOption(array $data, $product): FinishOption
    {
        $finishOption = FinishOption::where('finish_option_name', $data['finishOption'])->first();

        if (!array_key_exists('finish_option_description', $data)) {
            $data['finish_option_description'] = '';
        }

        if (!$finishOption) {
            $finishOption = FinishOption::create([
                'finish_option_name' => $data['finishOption'],
                'finish_option_description' => $data['finish_option_description'],
            ]);
        }

        $optionExists = false;
        foreach ($product->finishOptions as $option) {
            if ($option->finish_option_name == $finishOption->finish_option_name) {
                $optionExists = true;
            }
        }

        if (!$optionExists)
            $product->finishOptions()->attach($finishOption);

        return $finishOption;
    }

    /**
     * Get the add on option, if it is not in the database, create it.
     *
     * Attach it to the product and associate the image.
     *
     * @param array $data
     * @param $product
     * @param $image
     * @return AddOnOption
     */
    private function findOrCreateAddOnOption(array $data, $product, $image): AddOnOption
    {
        $addOnOption = AddOnOption::where('add_on_option', $data['addOnOption'])->first();

        if (!$addOnOption) {
            $addOnOption = AddOnOption::create([
                'add_on_option' => $data['addOnOption'],
                'is_per_light' => $data['addOnOptionIsPerLight'],
                'is_per_panel' => $data['addOnOptionIsPerPanel'],
                'is_price_same_for_all_sizes' => $data['addOnOptionIsPriceSameAllSizes'],
            ]);
        }

        $optionExists = false;
        foreach ($product->addOnOptions as $option) {
            if ($option->add_on_option == $addOnOption->add_on_option) {
                $optionExists = true;
            }
        }

        if (!$optionExists)
            $product->addOnOptions()->attach($addOnOption);

        if ($image) {
            $addOnOption->images()->detach();
            $addOnOption->images()->attach($image);
        }

        return $addOnOption;
    }
}
