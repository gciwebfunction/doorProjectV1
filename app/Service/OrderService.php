<?php

namespace App\Service;

use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Order\OrderRequest;
use DateInterval;
use DateTime;

class OrderService
{
    private $cartService;

    private $doorService;

    public function __construct()
    {
        $this->cartService = new CartService();
        $this->doorService = new DoorService();
    }


    /**
     * @param $user - The User object.
     * @return OrderRequest - a new OrderRequest object.
     */
    public function createOrderRequest($user,$status,$req_generator_type): OrderRequest
    {
        $shoppingCart                   = $this->cartService->getUserCart($user->id);
        // get the total of the products
        //echo dd($shoppingCart->cartItems);


        $concartItems    = count($shoppingCart->cartItems);
        if($concartItems >= 1 ){
            foreach ($shoppingCart->cartItems as $p=> $cartitem) {
                $quen[$p] = $cartitem['product_unit_price']*$cartitem['quantity'];
            }
            $ProductartSum = array_sum($quen);
        }else{
            $ProductartSum = 0;
        }

        //dd($shoppingCart->doorItems);
        //dd($shoppingCart->cartItems);
        $cartView                       = $this->doorService->getDoorViewObjectsForCart($shoppingCart);
        $getOrderSubtotal               = $cartView->getOrderSubtotal();

        $total_sub                      = $getOrderSubtotal+$ProductartSum;

        $defaultShippingDate            = new DateTime(); // Y-m-d
        $defaultShippingDate->add(new DateInterval('P30D'));

        $orderRequest                   = OrderRequest::create([
            'distributor_id'            => $user->id,
            'dealer_id'                 => -1,
            'user_id'                   => $user->id,
            'po_number'                 => '',
            'expected_shipping_date'    => $defaultShippingDate,
            //'total'                     => $cartView->getOrderSubtotal(),
            'total'                     => $total_sub,
            'status'                    => $status,
            'req_generator_type'        => $req_generator_type,
            //'status'                    => 1011,
            //'status' => 1001,
        ]);

        $condootItems    = count($shoppingCart->doorItems);
        if($condootItems >= 1 ) {
            foreach ($shoppingCart->doorItems as $item) {
                $item->update(['order_request_id' => $orderRequest->id]);
            }
        }


        if($concartItems >= 1 ){
            foreach ($shoppingCart->cartItems as $cartitem) {
                $cartitem->update(['order_request_id' => $orderRequest->id]);
            }
        }

        $shoppingCart->update(['is_active' => false]);

        return $orderRequest;
    }

    public function createOrderRequest_bk($user): OrderRequest
    {
        $shoppingCart                   = $this->cartService->getUserCart($user->id);
        $cartView                       = $this->doorService->getDoorViewObjectsForCart($shoppingCart);

        $defaultShippingDate            = new DateTime(); // Y-m-d
        $defaultShippingDate->add(new DateInterval('P30D'));

        $orderRequest                   = OrderRequest::create([
            'distributor_id'            => $user->id,
            'dealer_id'                 => -1,
            'user_id'                   => $user->id,
            'po_number'                 => '',
            'expected_shipping_date'    => $defaultShippingDate,
            'total'                     => $cartView->getOrderSubtotal(),
            'status'                    => 1011,
            //'status' => 1001,
        ]);

        foreach ($shoppingCart->doorItems as $item) {
            $item->update(['order_request_id' => $orderRequest->id]);
        }

        $shoppingCart->update(['is_active' => false]);

        return $orderRequest;
    }

    public function createOrder(OrderRequest $orderRequest): Order
    {
        $order = new Order();
        $order->created_by_user_id = auth()->user()->id;
        $order->original_order_request_user_id = $orderRequest->user_id;
        $order->distributor_id = $orderRequest->distributor_id;
        $order->dealer_id = $orderRequest->dealer_id;
        $order->purchase_order_number = $orderRequest->po_number;
        $order->required_shipping_date = $orderRequest->expected_shipping_date;
        $order->total_order_amount = $orderRequest->total;
        $order->save();


        foreach ($orderRequest->doorItems() as $doorItem) {
            $orderItem                  = new OrderItem();
            $orderItem->order_id        = $order->id;
            $orderItem->item            = $doorItem->door_name;
            $orderItem->prod_type       = $doorItem->category_name;
            $orderItem->door_type       = $doorItem->door_type_pretty_name;
            $orderItem->quantity        = $doorItem->quantity;
            $orderItem->unit_price      = $doorItem->price;

            foreach ($doorItem->doorItemModifiers() as $modifier) {
                if ($modifier->door_modifier_key == 'SIZE') {

                } else if ($modifier->door_modifier_key == 'SIZE') {
                    $split = explode(' ', $modifier->door_modifier_value);
                    $orderItem->width = $split[0];
                    $orderItem->height = $split[1];
                } else if ($modifier->door_modifier_key == 'COLOR') {
                    $orderItem->color_code = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'HANDLING') {

                } else if ($modifier->door_modifier_key == 'HANDLE') {
                    $orderItem->handle = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'LOCK') {
                    $orderItem->lock_set_type = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'GLASS_OPTION') {
                    $orderItem->glass_material = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'GLASS_DEPTH') {
                    $orderItem->glass_thickness = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'FRAME') {
                    $orderItem->door_frame = $modifier->door_modifier_value;
                }else if ($modifier->door_modifier_key == 'FRAME_THICKNESS_OPTION') {
                    $orderItem->frame_thickness = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'SILL_OPTION') {
                    $orderItem->sill_option = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'SILL_COLOR') {
                    $orderItem->sill_color = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'HINGE_COLOR_OPTION') {
                    $orderItem->hinge_color = $modifier->door_modifier_value;
                }else if ($modifier->door_modifier_key == 'HANDLE_COLOR_OPTION') {
                    $orderItem->handle_color = $modifier->door_modifier_value;
                }
            }

            $orderItem->save();
        }

        return $order;
    }


    public function requestUpdateOrder(OrderRequest $orderRequest): Order
    {
        $order                                  = new Order();
        $order->created_by_user_id              = auth()->user()->id;
        $order->original_order_request_user_id  = $orderRequest->user_id;
        $order->distributor_id                  = $orderRequest->distributor_id;
        $order->dealer_id                       = $orderRequest->dealer_id;
        $order->purchase_order_number           = $orderRequest->po_number;
        $order->required_shipping_date          = $orderRequest->expected_shipping_date;
        $order->total_order_amount              = $orderRequest->total;


        var_dump($order->required_shipping_date);

        $door_iterm = $orderRequest->doorItems();
        echo '<pre>';
        var_dump($door_iterm->door_name);
        echo '</pre>';
        die;

        //$order->save();


        foreach ($orderRequest->doorItems() as $doorItem) {
            dd($doorItem);

            $orderItem                  = new OrderItem();
            $orderItem->order_id        = $order->id;
            $orderItem->item            = $doorItem->door_name;
            $orderItem->prod_type       = $doorItem->category_name;
            $orderItem->door_type       = $doorItem->door_type_pretty_name;
            $orderItem->quantity        = $doorItem->quantity;
            $orderItem->unit_price      = $doorItem->price;

            foreach ($doorItem->doorItemModifiers() as $modifier) {
                if ($modifier->door_modifier_key == 'SIZE') {

                } else if ($modifier->door_modifier_key == 'SIZE') {
                    $split = explode(' ', $modifier->door_modifier_value);
                    $orderItem->width = $split[0];
                    $orderItem->height = $split[1];
                } else if ($modifier->door_modifier_key == 'COLOR') {
                    $orderItem->color_code = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'HANDLING') {

                } else if ($modifier->door_modifier_key == 'HANDLE') {
                    $orderItem->handle = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'LOCK') {
                    $orderItem->lock_set_type = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'GLASS_OPTION') {
                    $orderItem->glass_material = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'GLASS_DEPTH') {
                    $orderItem->glass_thickness = $modifier->door_modifier_value;
                } else if ($modifier->door_modifier_key == 'FRAME') {
                    $orderItem->door_frame = $modifier->door_modifier_value;
                }
            }

            $orderItem->save();
        }

        return $order;
    }
}
