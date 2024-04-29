<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order\CartItem;
use App\Models\Order\CartItemModifier;
use App\Models\Order\DoorItem;
use App\Models\Order\DoorItemModifier;
use App\Models\Order\ShoppingCart;
use App\Models\Product;
use App\Models\Product\Door\DoorFinishPrice;
use App\Models\Product\ProductOption;
use App\Service\CartService;
use App\Service\DoorService;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    private $doorService;

    private $shoppingCartService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->doorService = new DoorService();
        $this->shoppingCartService = new CartService();
    }

    public function addItemToCart($productId, $cartId)
    {
        $data = request()->all();

        //dd(data);

        $shoppingCart       = '';
        $productOptionId = $data['product_option_select'];
        $productOption = ProductOption::findOrFail($productOptionId);
        $user = Auth::user();
        if ($cartId < 1) {
            $shoppingCart = $this->shoppingCartService->getUserCart($user->id);
        } else {
            $shoppingCart = ShoppingCart::findOrFail($cartId);
        }

        $product    = Product::findOrFail($productId);
         $quantity   = $data['quantity'];

        $cartItem   = $this->saveCartItem($product, $shoppingCart, $productOption, $quantity );
        //$cartItem = $this->saveCartItem($product, $shoppingCart, $productOption, );

        return redirect()->route('cartviewdoor',
            ['shoppingCartId' => $cartId]);
    }

    public function addDoorToCart($productId, $cartId)
    {
        $door           = Product\Door\Door::findOrFail($productId);
        $doorPrice      = 0;
        $data           = '';
        $isgliding      = false;
        if (isset($door->category) && str_contains($door->category->category_name, 'Gliding')) {
            $isgliding = true;
        }

        if ($isgliding) {
            $data = request()->validate([
                'door_name_type_id_selection'   => 'required',
                'door_size_select'              => 'required',
                'handle_type_select'            => '',
                'lock_set_select'               => '',
                'door_color_select'             => 'required',
                'glass_grid_select'             => '',
                'glass_depth_select'            => '',
                'glass_option_select'           => '',
                'frame_thickness_select'        => '',
                'additional_notes'              => '',
                'opt_select'                    => '',
                'dp_option_select'              => '',
                'blind_option_select'           => '',
                'lite_option_select'            => '',
                'mull_kit_select'               => '',
                'screen_new_option_select'      => '',
                'hinge_color_option_select'     => '',
                'quantity'                      => '',
                'sill_option_select'            => '',
            ]);
        } else {
            $data = request()->validate([
                'door_name_type_id_selection'   => 'required',
                'door_size_select'              => 'required',
                'door_color_select'             => 'required',
                'door_handling_select'          => '',
                'dp_option_select'              => '',
                'glass_option_select'           => '',
                'blind_option_select'           => '',
                'glass_grid_select'             => '',
                'lite_option_select'            => '',
                'handle_type_select'            => '',
                'lock_set_select'               => '',
                'frame_thickness_select'        => '',
                'sill_option_select'            => '',
                'screen_new_option_select'      => '',
                'mull_kit_select'               => '',
                'handle_color_option_select'    => '',
                'lock_color_option_select'      => '',
                'sill_color_option_select'      => '',
                'hinge_color_option_select'     => '',

                //'door_frame_select'           => 'required',
                //'glass_depth_select'          => '',

                'additional_notes'              => '',
                'opt_select'                    => '',
                'quantity'                      => '',

            ]);
        }

        //dd($data);
        $shoppingCart = '';

        $user = Auth::user();
        if ($cartId < 1) {
            $shoppingCart = $this->shoppingCartService->getUserCart($user->id);
        } else {
            $shoppingCart = ShoppingCart::findOrFail($cartId);
        }
        // Switch
        // TODO: Don't remember what we are switching on

        foreach ($door->customOptions as $customOption) {
            request()->validate([
                'custom_option-' . $customOption->id => 'required',
            ]);
            $custVal = request()->get('custom_option-' . $customOption->id);
            $data['custom_option-' . $customOption->id] = $custVal;
        }

        $doorName                   = Product\Door\DoorName::findOrFail($data['door_name_type_id_selection']);

        $doorItem                   = DoorItem::create([
            'shopping_cart_id'      => $cartId,
            'door_id'               => $productId,
            'door_name'             => $doorName->door_name_or_type,
            'category_name'         => $door->category->category_name,
            'door_type_pretty_name' => $door->doorType->door_type_pretty_name,
            'quantity'              => $data['quantity'],
            //'quantity'              => 1,
            'price'                 => 0,
        ]);

        // SAVE THE DOOR SIZE
        $this->saveDoorItemModifier($doorItem->id, 'SIZE', $this->getMeasurementValue($data['door_size_select']),
            false, 1, -1);

        // LOOKUP REQUIRED DOOR ADDITIONAL OPTIONS
        $color          = Product\Door\InteriorColor::find($data['door_color_select']);
        $measurement    = Product\Door\DoorMeasurement::find($data['door_size_select']);
        $finish         = Product\Door\DoorFinishPrice::where('door_measurement_id', $measurement->id)
            ->where('interior_color_id', $color->id)->first();





        if (isset($data['glass_depth_select']))
            $glassDepth = Product\Door\AdditionalOption::find($data['glass_depth_select']);
        if (isset($data['glass_option_select']))
            $glassOption = Product\Door\AdditionalOption::find($data['glass_option_select']);
        if (isset($data['frame_thickness_select']))
            $thicc = Product\Door\AdditionalOption::find($data['frame_thickness_select']);
        $notes = $data['additional_notes'];
        if (isset($data['lock_set_select']))
            $lock = Product\Door\AdditionalOption::find($data['lock_set_select']);
        if (isset($data['handle_type_select']))
            $handleType = Product\Door\AdditionalOption::find($data['handle_type_select']);

        // two new option 1--  dp_option_select 2--frame_thickness_select
        if (isset($data['dp_option_select']))
            $dpOption = Product\Door\AdditionalOption::find($data['dp_option_select']);

        if (isset($data['frame_thickness_select']))
            $frameThickness = Product\Door\AdditionalOption::find($data['frame_thickness_select']);

        if (isset($data['sill_option_select']))
            $sillOption = Product\Door\AdditionalOption::find($data['sill_option_select']);

        if (isset($data['mull_kit_select']))
            $mullKit = Product\Door\AdditionalOption::find($data['mull_kit_select']);

        if (isset($data['screen_new_option_select']))
            $screenNew = Product\Door\AdditionalOption::find($data['screen_new_option_select']);

        if (isset($data['glass_grid_select']))
            $glassGrid = Product\Door\AdditionalOption::find($data['glass_grid_select']);



        if (isset($data['blind_option_select']))
            $blindOption = Product\Door\AdditionalOption::find($data['blind_option_select']);

        if (isset($data['lite_option_select']))
            $liteOption = Product\Door\AdditionalOption::find($data['lite_option_select']);


        if (isset($data['handle_color_select']))
            $handleColorOption = Product\Door\AdditionalOption::find($data['handle_color_select']);

        if (isset($data['lock_color_select']))
            $lockColorOption = Product\Door\AdditionalOption::find($data['lock_color_select']);

        if (isset($data['screen_new_option_select']))
            $screenOption = Product\Door\AdditionalOption::find($data['screen_new_option_select']);

        if (isset($data['hinge_color_option_select']))
            $hingeColorOption = Product\Door\AdditionalOption::find($data['hinge_color_option_select']);


        //SCREEN_OPTION


        // FIND CUSTOM ADDON OPTIONS
        $customOptions = [];
        foreach ($door->customOptions as $key => $value) {
            $addOptIdFromRequest = $data['custom_option-' . $value->id];
            $customOptions[] = Product\Door\AdditionalOption::find($addOptIdFromRequest);
        }

        // SAVE THE OPTIONS WITH THE CART ITEM
        if (isset($data['opt_select'])) {
            $this->saveDoorItemModifier($doorItem->id, 'SPEC', $data['opt_select'], false, 1, 0);
        }
        $this->saveDoorItemModifier($doorItem->id, 'COLOR', $color->color ?? '', true, 1, $finish->price ?? 0);
        if (!$isgliding) {
            $handling = Product\Door\DoorHandling::find($data['door_handling_select']);
            //$frame = Product\Door\DoorFrame::find($data['door_frame_select']);
            $this->saveDoorItemModifier($doorItem->id, 'HANDLING', $handling->handling ?? '', false, 0, 0);
            //$this->saveDoorItemModifier($doorItem->id, 'FRAME', $frame->frame ?? '', false, 0, 0);
        }

        if (isset($handleType))
            $this->saveDoorItemModifier($doorItem->id, 'HANDLE', $handleType->name ?? '', false, $handleType->multiplier, $handleType->price ?? 0);
        if (isset($lock))
            $this->saveDoorItemModifier($doorItem->id, 'LOCK', $lock->name ?? '', false, $lock->multiplier, $lock->price ?? 0);
        $this->saveDoorItemModifier($doorItem->id, 'NOTES', $notes ?? '', false, 0, 0);
//        if (isset($thicc))
//            $this->saveDoorItemModifier($doorItem->id, 'THIC', $thicc->name ?? '', false, $thicc->multiplier, $thicc->price);
        if (isset($glassOption))
            $this->saveDoorItemModifier($doorItem->id, 'GLASS_OPTION', $glassOption->name ?? '', false, $glassOption->multiplier, $glassOption->price ?? 0);

//        if (isset($glassDepth))
//            $this->saveDoorItemModifier($doorItem->id, 'GLASS_DEPTH', $glassDepth->name ?? '', false, $glassDepth->multiplier, $glassDepth->price ?? 0);


        if (isset($dpOption))
            $this->saveDoorItemModifier($doorItem->id, 'DP_OPTION', $dpOption->name ?? '', false, $dpOption->multiplier, $dpOption->price ?? 0);

        if (isset($frameThickness))
            $this->saveDoorItemModifier($doorItem->id, 'FRAME_THICKNESS_OPTION', $frameThickness->name ?? '', false, $frameThickness->multiplier, $frameThickness->price ?? 0);

        if (isset($sillOption))
            $this->saveDoorItemModifier($doorItem->id, 'SILL_OPTION', $sillOption->name ?? '', false, $sillOption->multiplier, $sillOption->price ?? 0);

        if (isset($mullKit))
            $this->saveDoorItemModifier($doorItem->id, 'MULL_KIT', $mullKit->name ?? '', false, $mullKit->multiplier, $mullKit->price ?? 0);

        //if (isset($screenNew))
            //$this->saveDoorItemModifier($doorItem->id, 'MULL_KIT', $screenNew->name ?? '', false, $screenNew->multiplier, $screenNew->price ?? 0);


        // SAVE CUSTOM ADDON OPTIONS
        foreach ($customOptions as $key => $value) {
            $this->saveDoorItemModifier($doorItem->id, $value->group_name, $value->name ?? '', false, $value->multiplier, $value->price ?? 0);
        }



        //blindOption select
        if (isset($blindOption)){
            $this->saveDoorItemModifier($doorItem->id, 'BLIND_OPTION', $blindOption->name, false, $blindOption->multiplier, $blindOption->price);
        }

        // Glass Grid
        if (isset($glassGrid)){
            $this->saveDoorItemModifier($doorItem->id, 'GLASS_GRID', $glassGrid->name, false, $glassGrid->multiplier, $glassGrid->price);
        }


        // lite option select
        if (isset($liteOption)){
            $this->saveDoorItemModifier($doorItem->id, 'LITE_OPTION', $liteOption->name, false, $liteOption->multiplier, $liteOption->price);
        }


        // mull kit select
        if (isset($mullOption)){
            $this->saveDoorItemModifier($doorItem->id, 'MULL_KIT', $mullOption->name, false, $mullOption->multiplier, $mullOption->price);
        }


        // handle color select
        if (isset($handleColorOption)){
            $this->saveDoorItemModifier($doorItem->id, 'HANDLE_COLOR_OPTION', $handleColorOption->name, false, $handleColorOption->multiplier, $handleColorOption->price);
        }


        // lock color select
        if (isset($lockColorOption)){
            $this->saveDoorItemModifier($doorItem->id, 'LOCK_COLOR_OPTION', $lockColorOption->name, false, $lockColorOption->multiplier, $lockColorOption->price);
        }


        // sill color select
        if (isset($sillColorOption)){
            $this->saveDoorItemModifier($doorItem->id, 'SILL_COLOR_OPTION', $sillColorOption->name, false, $sillColorOption->multiplier, $sillColorOption->price);
        }

        // Hinge color select
        if (isset($hingeColorOption)){
            $this->saveDoorItemModifier($doorItem->id, 'HINGE_COLOR_OPTION', $hingeColorOption->name, false, $hingeColorOption->multiplier, $hingeColorOption->price);
        }



        if (isset($screenOption)){
            $this->saveDoorItemModifier($doorItem->id, 'SCREEN_OPTION', $screenOption->name, false, $screenOption->multiplier, $screenOption->price);
        }

        $doorPrice = $this->getDoorPrice($doorItem, $finish, $door->panel_count);

        $doorItem->update([
            'price' => $doorPrice,
        ]);

        return redirect()->route('cartviewdoor',
            ['shoppingCartId' => $cartId]);
    }




    public
    function viewCart($shoppingCartId)
    {
        //dd('adada');

        if ($shoppingCartId == 0) {
            $user = auth()->user();
            $shoppingCarts = ShoppingCart::where('user_id', $user->id)->where('is_active', 1)->get();
            if ($shoppingCarts->first()) {
                $shoppingCart = $shoppingCarts->first();
            }
        } else {
            $shoppingCart = ShoppingCart::find($shoppingCartId);
        }

        if (isset($shoppingCart)) {
            $cartItems = $shoppingCart->cartItems;

            $orderSubtotal = 0;
            $orderDiscount = 0;
            $orderTax = 0;
            $orderTaxRate = 0;
            $orderDiscountRate = 0;
            $orderTotal = 0;

            foreach ($shoppingCart->cartItems as $item) {
                $orderSubtotal += $item->product_unit_price;

                // TODO: Add Modifiers
            }


            $orderDiscount  = $orderSubtotal * $orderDiscountRate;
            $orderTax       = $orderSubtotal * $orderTaxRate;
            $orderTotal     = $orderSubtotal + $orderTax - $orderDiscount;

            //$viewObject->setPrice(sprintf('%01.2f', $cartItem->price));

            return view('shoppingcart.view', [
                'shoppingCart' => $shoppingCart,
                'cartItemCount' => sizeof($cartItems),
                'orderTotal' => sprintf('%01.2f', $orderTotal),
                'cartSubtotal' => sprintf('%01.2f', $orderSubtotal),
                'orderDiscount' => sprintf('%01.2f', $orderDiscount),

            ]);
        }

        return view('shoppingcart.view');
    }

    public
    function viewDoorCart($shoppingCartId)
    {
        //die('Mano Work');
        $user           = auth()->user();
        $shoppingCart   = $this->shoppingCartService->getUserCart($user->id);
        $cartView       = $this->doorService->getDoorViewObjectsForCart($shoppingCart);

        dd($cartView);
        $orderTotal     = $cartView->getOrderTotal();
        $orderSubtotal  = $cartView->getOrderSubtotal();

        foreach ($shoppingCart->cartItems as $item) {
            //$orderSubtotal += $item->product_unit_price;
            $orderSubtotal += ($item->product_unit_price)*($item->quantity);
            //die($orderSubtotal);
            // TODO: Add Modifiers
        }
        $cartDiscount   = $cartView->getOrderDiscount();
        $orderTotal     = $orderSubtotal - $cartDiscount;

        return view('shoppingcart.viewdoor', [
            'shoppingCart'  => $shoppingCart,
            'doorViewItems' => $cartView->getDoorViewObjects(),
            'cartItemCount' => $cartView->getCartItemCount(),
            'orderTotal'    => sprintf('%01.2f', $orderTotal),
            'cartSubtotal'  => sprintf('%01.2f', $orderSubtotal),
            'orderDiscount' => sprintf('%01.2f', $cartDiscount),
        ]);
    }

    public function deleteCartDoorItem($id)
    {
        $doorItem = DoorItem::findOrFail($id);
        foreach ($doorItem->doorItemModifiers as $mod) {
            $mod->delete();
        }

        $doorItem->delete();
    }

    public
    function deleteCartItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        foreach ($cartItem->cartItemModifiers as $mod) {
            $mod->delete();
        }
        $cartItem->delete();
    }

    private
    function saveCartItem(Product $product, ShoppingCart $shoppingCart, ProductOption $productOption , $quantity): CartItem
    {
        //echo $quantity;die;
        $cartItem = CartItem::create([
            'shopping_cart_id'      => $shoppingCart->id,
            'product_id'            => $product->id,
            'product_name'          => $product->product_name,
            'quantity'              => $quantity,
            //'quantity'              => 1,
            'product_unit_price'    => $productOption->option_price,
            'option_name'           => $productOption->option_name,
            'product_color'         => $productOption->option_color,
            'product_size'          => $productOption->option_size,
        ]);

        return $cartItem;
    }

    public
    function clearCart($cartId)
    {
        $cart = ShoppingCart::findOrFail($cartId);
        $cart->is_active = 0;
        $cart->save();

        return redirect()->route('dashboard', ['categories' => Category::all()]);
    }

    private
    function saveCartItemModifier(string $option, CartItem $cartItem, string $optionType, $price, $sizeCode): CartItemModifier
    {
        $cartItemModifier = new CartItemModifier();

        $cartItemModifier->cart_item_id = $cartItem->id;
        $cartItemModifier->option_type = $optionType;
        $cartItemModifier->option_name = $option;
        $cartItemModifier->option_additional_price = $price;
        $cartItemModifier->size_code = $sizeCode;

        $cartItemModifier->save();

        return $cartItemModifier;
    }

    private
    function getMeasurementValue($id): string
    {
            $doorMeasurement = Product\Door\DoorMeasurement::findOrFail($id);

        return 'W' . $doorMeasurement->width . ' H' . $doorMeasurement->height;
    }

    private
    function saveDoorItemModifier($id, string $key, string $value, bool $isBasePrice, int $multiplier, int $price): DoorItemModifier
    {
        return DoorItemModifier::create([
            'door_item_id'          => $id,
            'door_modifier_key'     => $key,
            'door_modifier_value'   => $value,
            'is_base_price'         => $isBasePrice,
            'price_multiplier'      => $multiplier,
            'price'                 => $price,
        ]);
    }

    /**
     * @param DoorItem $doorItem
     * @param DoorFinishPrice $finish
     * @return void
     */
    private
    function getDoorPrice(DoorItem $doorItem, DoorFinishPrice $finish, $panel_count)
    {
        $base = $finish->price;

        foreach ($doorItem->doorItemModifiers as $mod) {
            if ($mod->door_modifier_key != 'COLOR' && $mod->door_modifier_key != 'SIZE') {
                $modPrice = $mod->price * $mod->price_multiplier;
                /*if ($mod->door_modifier_key == 'GLASS_GRID') {
                    $modPrice *= $panel_count;
                }*/
                $base += $modPrice;
            }
        }

        return $base;
    }


    private
    function saveCartItem_bkk(Product $product, ShoppingCart $shoppingCart, ProductOption $productOption): CartItem
    {
        $cartItem = CartItem::create([
            'shopping_cart_id' => $shoppingCart->id,
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'quantity' => 1,
            'product_unit_price' => $productOption->option_price,
            'option_name' => $productOption->option_name,
            'product_color' => $productOption->option_color,
            'product_size' => $productOption->option_size,
        ]);

        return $cartItem;
    }


}
