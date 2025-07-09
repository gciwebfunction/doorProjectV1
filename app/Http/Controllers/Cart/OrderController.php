<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Order\OrderRequest;
use App\Models\Order\ShoppingCart;
use App\Models\Order\Status;
use App\Models\User;

use App\Models\Order\DoorItem;

use App\Models\OrderRequestMessage;
use App\Models\OrderRequestNote;

use App\Service\CartService;
use App\Service\OrderService;
use App\Service\DoorService;
#use Illuminate\Http\Request;

use http\Env\Request;
use Illuminate\Support\Facades\Session;
use DB;

use Carbon\Carbon;

class OrderController extends Controller
{

    private $cartService;
    private $doorService;
    private $orderService;
    private $shoppingCartService;
    private $str;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->cartService      = new CartService();
        $this->orderService     = new OrderService();
        $this->doorService      = new DoorService();
        //$this->shoppingCartService = new CartService();
    }


    public function search(){
        //return view('order.search',['oRs' => $orderRequests]);
        return view('order.search');
        //die('sfsf');
        //dd(request());
    }

    // function is used when user submit an order request
    public function createOrderRequestStepOne($cartId)
    {
        $user           = auth()->user();

        // set the status on base of user
        //dd($user->usertype);

        //dd('asdadd');

        $user_tpe           = $user->usertype;
        $req_generator_type = $user_tpe;

        switch ($user_tpe){
            case "dealer":
                $status = '1013';
                break;
            case "distributor":
                $status = '1011';
                break;
            default:// for direct dealer
                $status = '1011';
        }


        $orderRequest   = $this->orderService->createOrderRequest($user, $status, $req_generator_type);
        $this->cartService->clearUserCart($user);

        Session::flash('success', 'Order request created and passed to the Manufacturer');
        return redirect()->route('orviewsteptwo', ['orId' => $orderRequest->id]);
    }


    public function createOrderRequestStepTwo()
    {

        $user = auth()->user();

        $data = request()->validate([
            'address1'              => 'required',
            'order_request_id'      => 'required',
            'zipcode'               => 'required',
            'city'                  => 'required',
            'state'                 => 'required',
            'additionalInformation' => '',
            'expected_shipping_date'=> 'required',
            'shipping_instruction'  => '',
            'package_instruction'   => '',
            'po_number'             => '',

        ]);

        $orderRequest        = OrderRequest::findOrFail($data['order_request_id']);
        $address             = Address::create([
            'address'        => $data['address1'],
            'postal_code'    => $data['zipcode'],
            'city'           => $data['city'],
            'state'          => $data['state'],
        ]);

        $request_level      = '2';

        if($user->usertype  == 'dealer') {
            $request_type   = '3 level';
            //$request_level  = '2';
        //}elseif($user->usertype == 'Direct dealer' || $user->usertype=='distributor' ){
        }elseif($user->usertype == 'direct_dealer' || $user->usertype=='distributor' ){
            $request_type   = '2 level';
            //$request_level  = '2';
        }else{
            $request_type   = '';
        }


        $time                   = $data['expected_shipping_date'];
        //$date_expp              = Carbon::createFromFormat('m-d-Y', $time);
        //$exp_shipping_date      = $date_expp->format('Y-m-d');
        $exp_shipping_date      = date ('Y-m-d' , strtotime($time));

        $shipping_instruction   = $data['shipping_instruction'];
        $package_instruction    = $data['package_instruction'];
        $po_number              = $data['po_number'];


        $orderRequest->update([
            'ship_to'                => $address->id,
            'expected_shipping_date' => $exp_shipping_date,
            'request_type'           => $request_type,
            'current_level'          => $request_level,
            'package_instruction'    => $package_instruction,
            'shipping_instruction'   => $shipping_instruction,
            'po_number'              => $po_number,
        ]);


        $message                    = $data['additionalInformation'];
        if (!empty($message)) {
            OrderRequestNote::create([
                'order_note'        => $data['additionalInformation'],
                'user_id'           => $user->id,
                'order_request_id'  => $data['order_request_id']
            ]);
        }

        if ($user->hasPermission('u_order_request')) {
            return redirect()->route('oview');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function showOrderRequests()
    {

        $message = $this->loadSessionMessages(request()->session());

        $orderRequests = OrderRequest::where('user_id', auth()->user()->id)->get();

        return view('orderrequest.view',
            ['oRs' => $orderRequests,
                'message' => $message,
                'status' => Status::all()]);
    }

    public function showOrders()
    {
        $user = auth()->user();
        $user           = auth()->user();
        $user_id        = $user->id;
        $user_tpe       = $user->usertype;

        //echo '<pre>';var_dump($user->usertype); echo '</pre>';die;

        // direct dealer
        switch ($user_tpe):
            case "manufacturer":
                $orderRequests = OrderRequest::orderBy('id', 'desc')->get();
                $allOrders     = Order::orderBy('id', 'desc')->get();
                break;
            case "distributor":
                //$orderRequests = OrderRequest::orderBy('id', 'desc')->get();
                $orderRequests = DB::select("
                        SELECT order_requests.* 
                        FROM  order_requests 
                        INNER JOIN users ON users.id = order_requests.user_id 
                        WHERE users.id = $user_id OR users.distributor_id = $user_id order by order_requests.id desc  ");

                $allOrders     =  DB::select("
                        SELECT orders.* 
                        FROM  orders 
                        INNER JOIN users ON users.id = orders.original_order_request_user_id 
                        WHERE users.id = $user_id OR users.distributor_id = $user_id order by orders.id desc   ");
                break;
            case "dealer":
                $orderRequests =  DB::table('order_requests')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
                $allOrders     =  DB::table('orders')->where('original_order_request_user_id', $user_id)->orderBy('id', 'DESC')->get();
                break;
            case 'direct_dealer':
                $orderRequests =  DB::table('order_requests')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
                $allOrders     =  DB::table('orders')->where('original_order_request_user_id', $user_id)->orderBy('id', 'DESC')->get();
                break;

            default:// for direct dealer
                $orderRequests = OrderRequest::orderBy('id', 'desc')->get();
                $allOrders     = Order::orderBy('id', 'desc')->get();
            //$allOrders      = \App\Models\Order\Order::all();
        endswitch;
        //dd($orderRequests);


        return view('order.view', [
            //'orders'    => \App\Models\Order\Order::all(),
            'orders'    => $allOrders,
            'oRs'       => $orderRequests,
            'status'    => \App\Models\Order\Status::all(),
            'user'      => $user
        ]);
    }


    public function orPrint($orId){


        // get the address of ship

        $orderData                   = Order::findOrFail($orId);
        //dd($orderData);
        $ship_to_add                 = $orderData->ship_to;

        $order_requester_id          = $orderData->original_order_request_user_id;

        // get the detail of user which generated the order for buyer info
        $buyer_address               = DB::table('addresses')->where('user_id', $order_requester_id)->orderBy('id', 'ASC')->get();
        //dd($shipping_address);
        $buyer_addres                = $buyer_address[0]->address??null;
        $buyer_addre2                = $buyer_address[0]->address2??null;
        $buyer_state                 = $buyer_address[0]->state??null;
        $buyer_city                  = $buyer_address[0]->city??null;
        $buyer_postal_code           = $buyer_address[0]->postal_code??null;


        //$orderData->
        // get the shipping details
        $ship_address               = DB::table('addresses')->where('id', $ship_to_add)->orderBy('id', 'ASC')->get();
        $ship_addres                = $ship_address[0]->address??null;
        $ship_addre2                = $ship_address[0]->address2??null;
        $ship_state                 = $ship_address[0]->state??null;
        $ship_city                  = $ship_address[0]->city??null;
        $ship_postal_code           = $ship_address[0]->postal_code??null;



        $orderItems                     =  DB::table('order_items')->where('order_id', $orId)->get();
        //dd($orderItems);
        $doorItem                       = DB::table('door_items')->where('order_id', $orId)->limit(1)->get()->toArray();
        // get the order request id from the door_items table
        $order_request_id               = $doorItem[0]->order_request_id;
        $orderRequestProducts           = DB::table('cart_items')->where('order_request_id', $order_request_id)->orderBy('id', 'ASC')->get();
        if (empty($orderRequestProducts)) {
            $orderRequestProducts == null;
        }
        //'orderRequestProducts'  => $orderRequestProducts

        // get the manugacturesr daeteil
        //echo  $orderData->original_order_request_user_id;
        //die;
        $user                     =  auth()->user();
        $user_id                  = $user->id;
        $userContact              = DB::table('user_contacts')->where('user_id', $order_requester_id)->orderBy('id', 'ASC')->get()->toArray();

        $buyer_primay_phone      = $userContact[0]->primary_phone??0;
        //dd($userContact);

        return view('order.orPrint', [
            'orderData'             => $orderData,
            'orderItems'            => $orderItems,
            'orderRequestProducts'  => $orderRequestProducts,
            'userData'              => $user,
            'userContact'           => $userContact,


            'buyer_addres'          => $buyer_addres,
            'buyer_addres2'         => $buyer_addre2,
            'buyer_city'            => $buyer_city,
            'buyer_state'           => $buyer_state,
            'buyer_postal_code'     => $buyer_postal_code,
            'buyer_primary_phone'   => $buyer_primay_phone,

            'ship_addres'           => $ship_addres,
            'ship_addres2'           => $ship_addre2,
            'ship_city'             => $ship_city,
            'ship_state'            => $ship_state,
            'ship_postal_code'      => $ship_postal_code,

        ]);
    }


    public function test()
    {
        $user = auth()->user();
        //dd($user->id);
    }

    // from distributor to manufacturer
    public function UpdateOrderRequest($status, $orRequestId){
        $user           = auth()->user();
        $orderRequest   = OrderRequest::findOrFail($orRequestId);
        $orderRequest->update(['status' => $status]);
        return redirect()->route('oview');
    }


    public function editManufacturerform($orRequestId)
    {

        $user           = auth()->user();

        $orderRequest   = OrderRequest::findOrFail($orRequestId);

        // for third level condition
        if (
            ( $user->usertype == 'manufacturer' &&  $orderRequest->request_type == '3 level' && $orderRequest->current_level == '3')  or
            ( $user->usertype == 'sales' &&  $orderRequest->request_type == '3 level' && $orderRequest->current_level == '3')  or
            ( $user->usertype == 'sales_user' &&  $orderRequest->request_type == '3 level' && $orderRequest->current_level == '3')  or


            ( $user->usertype == 'distributor'  && $orderRequest->request_type == '3 level' && $orderRequest->current_level == '4')  or
            ( $user->usertype == 'dealer'  && $orderRequest->request_type == '3 level' && $orderRequest->current_level == '5') or
            // for two level
            ( $user->usertype == 'manufacturer' &&  $orderRequest->request_type == '2 level' && $orderRequest->current_level == '2')

            // for the sales guys
            or ( $user->usertype == 'sales' &&  $orderRequest->request_type == '2 level' && $orderRequest->current_level == '2')
            or ( $user->usertype == 'sales_user' &&  $orderRequest->request_type == '2 level' && $orderRequest->current_level == '2')

        ) {
            $orderrequestitems = DB::table('door_items')->where('order_request_id', $orRequestId)->orderBy('id', 'ASC')->get();

            $item_arr       = array();
            $itemTotal_dis  = 0;
            $itemTotals     = 0;

            foreach ($orderrequestitems as $k => $item) {
                $item_arr[$k]['item_id']         = $item->id;
                $item_arr[$k]['category_name']   = $item->category_name;
                $item_arr[$k]['door_name']       = $item->door_name;
                $item_arr[$k]['quantity']        = $item->quantity;
                $item_arr[$k]['price']           = $item->price;
                $item_arr[$k]['discount_amount'] = $item->discount_amount;
                $item_arr[$k]['calculated_discount'] = $item->calculated_discount;
                $item_arr[$k]['discount_type']   = $item->discount_type;
                $item_arr[$k]['assemble_knock']  = $item->assemble_knock;
                $itemTotal_dis += $item->calculated_discount;
                $itemTotals += (($item->price*$item->quantity)-$item->calculated_discount);


                $orderrequestitems = DB::table('door_item_modifiers')->where('door_item_id', $item->id)->orderBy('id', 'ASC')->get();
                foreach ($orderrequestitems as $orderrequestitem) {
                    $key = $orderrequestitem->door_modifier_key;
                    $item_arr[$k][$key] = $orderrequestitem->door_modifier_value;
                }
            }


            // get the address of shipping
            $address_id             = $orderRequest->ship_to;
            $shipping_address       = DB::table('addresses')->where('id', $address_id)->get();
            $shipping_add           = $shipping_address[0]->address.' '.$shipping_address[0]->city.' '.$shipping_address[0]->state.' '.$shipping_address[0]->postal_code;

            $OrderRequestNote       = DB::table('order_request_notes')->where('order_request_id', $orRequestId)->get();
            //dd($OrderRequestNote);

            // all the order products
            $orderRequestProducts    = DB::table('cart_items')->where('order_request_id', $orRequestId)->orderBy('id', 'ASC')->get();



            //return view('order.Editmanufacturerform', [
            return view('order.editManufacturerform', [
                'orderRequest'          => $orderRequest,
                'status'                => \App\Models\Order\Status::all(),
                'user'                  => $user,
                'item_arr'              => $item_arr,
                'shipping_address'      => $shipping_add,
                'orderRequestnotes'     => $OrderRequestNote,
                'itemTotal_dis'         => $itemTotal_dis,
                'itemTotals'            => $itemTotals,
                'orderRequestProducts'  => $orderRequestProducts
            ]);

        }
        else{
            return redirect()->route('oview');
        }
    }


    public function Editmanufacturerreq(){


        $user                   = auth()->user();
        $data                   = request()->all();
        $order_request_Id       = $data['order_request_id'];

        $orderReq_data          = OrderRequest::findOrFail($order_request_Id);

        $req_generator_type     = $data['req_generator_type'];
        $request_type           = $data['request_type'];
        $current_level          = $data['current_level'];
        $shipping_fee           = $data['shipping_fee'];

        $mull_fee               = $data['mull_fee'];

        $freight_term           = $data['freight_term'];
        $transportation_mode    = $data['transportation_mode'];
        $shipping_instruction   = $data['shipping_instruction'];
        //$shipping_address       = $data['shipping_address'];
        $package_instruction    = $data['package_instruction'];
        $po_number              = $data['po_number'];

        $total                  = $data['total'];

        // manufacturer edit
        if (
            ($request_type == '3 level' && $current_level == '3'  && $user->usertype == 'manufacturer')
            or  ($request_type == '3 level' && $current_level == '4'  && $user->usertype == 'distributor')
            or  ($request_type == '3 level' && $current_level == '5'  && $user->usertype == 'dealer')
            or  ($request_type == '2 level' && $current_level == '2' && $user->usertype == 'manufacturer')
            or  ($request_type == '2 level' && $current_level == '2' && $user->usertype == 'sales')
            or  ($request_type == '2 level' && $current_level == '2' && $user->usertype == 'sales_user')
            or  ($request_type == '2 level' && $current_level == '2' && $user->usertype == 'sales_manager')
        ) {
            //$po_number              = $data['po_number'];

            if (array_key_exists('add_disc_type', $data)) {
                $add_disc_val   = $data['add_disc_val'];
                $add_disc_amt   = $data['add_disc_amt'];
                $add_disc_type  = $data['add_disc_type'];
            } else {
                $add_disc_type  = '';
                $add_disc_val   = 0;
                $add_disc_amt   = 0;
            }

            if (array_key_exists('add_sel', $data)) {
                $shipping_add = $data['add_sel'];

                // for the address
                if ($shipping_add == 'Own') {
                    // get the user address id and save it in order request table
                    $user_add_pbj = json_decode($user->address, true);
                    $ship_to = $user_add_pbj['id'];
                    DB::table('order_requests')->where('id', $order_request_Id)->update([
                        'ship_to' => $ship_to,
                        'shipping_address' => $shipping_add,
                    ]);
                }

                if ($shipping_add == 'Drop Shipping') {
                    // make entry of address and save its ref
                    //Address::create([
                    $ship_to = DB::table('addresses')->insertGetId([
                        'address' => $data['dropshipadd'],
                        'state' => $data['state'],
                        'city' => $data['city'],
                        'postal_code' => $data['zip']
                    ]);
                    DB::table('order_requests')->where('id', $order_request_Id)->update([
                        'ship_to' => $ship_to,
                        'shipping_address' => $shipping_add
                    ]);
                }
            }


            // check order request type  nd set status
            //if ($req_generator_type == 'dealer') {$status = 1014;} else {$status = 1013;}

            //$orderRequest           = OrderRequest::findOrFail($order_request_Id);
            if($request_type == '2 level' && $current_level == '2' && $user->usertype == 'manufacturer'){
                $status         = 1013;
                $current_level  = 3;
            }else{
                $status         = $orderReq_data->status;
                $current_level  = $orderReq_data->current_level;
            }

            DB::table('order_requests')->where('id', $order_request_Id)->update([
                'status'                => $status,
                'current_level'         => $current_level,
                'add_disc_type'         => $add_disc_type,
                'add_disc_amt'          => $add_disc_amt,
                'add_disc_val'          => $add_disc_val,
                'freight_term'          => $freight_term,
                'transportation_mode'   => $transportation_mode,
                'shipping_instruction'  => $shipping_instruction,
                'package_instruction'   => $package_instruction,
                'shipping_fee'          => $shipping_fee,
                'mull_fee'              => $mull_fee,
                'po_number'             => $po_number,

                'total'                 => $total
                //'po_number'              => $po_number,
                //'shipping_address'       => $shipping_address
            ]);

            if (array_key_exists('order_note', $data)) {
                $order_note = $data['order_note'];
                if (!empty($order_note)) {
                    OrderRequestNote::create([
                        'order_note'        => $order_note,
                        'user_id'           => $user->id,
                        'order_request_id'  => $order_request_Id
                    ]);
                }
            }

            if (array_key_exists('message', $data)) {
                $message = $data['message'];
                if (!empty($message)) {
                    OrderRequestMessage::create([
                        'message'           => $message,
                        'user_id'           => $user->id,
                        'order_request_id' => $order_request_Id
                    ]);
                }
            }

            foreach ($data['items'] as $kkk => $item_id) {

                DB::table('door_items')->where('id', $item_id)->update([
                    'discount_type'         => $data['discount_type'][$kkk],
                    'discount_amount'       => $data['discount_amount'][$kkk],
                    'calculated_discount'   => $data['calculated_discount'][$kkk],
                    'sub_total'             => $data['sub_total'][$kkk]
                ]);
            }
            //dd('sdsdssdsad');
            //return redirect()->action('OrderController@showOrders');

            // here if the step is two and 


            return redirect()->route('oview');
        }else{
            return redirect()->route('oview');
        }
    }


    public function Editmanufacturerdetailview($orRequestId){

        $user                               = auth()->user();
        $user_id                            = $user->id;

        //$userContact                        = DB::table('user_contacts')->where('user_id', $user_id)->orderBy('id', 'ASC')->get()->toArray();

        //$userContact->ship_to;

        $disti_address            = DB::table('addresses')->where('user_id',$user_id)->get();

        //dd($disti_address);
        $disti_addr               = $disti_address[0]->address??null;
        $disti_addr2              = $disti_address[0]->address2??null;
        $disti_city               = $disti_address[0]->city??null;
        $disti_pcode              = $disti_address[0]->postal_code??null;
        $disti_st                 = $disti_address[0]->state??null;
        $addd_comp                = $disti_addr.' '.$disti_addr2.' '.$disti_city.' '.$disti_pcode.' '.$disti_st;
        //echo $addd_comp;die;

        $orderRequest                       = OrderRequest::findOrFail($orRequestId);
        $orderrequestitems                  = DB::table('door_items')->where('order_request_id', $orRequestId)->orderBy('id', 'ASC')->get();



        $item_arr = array();
        $sub_total= 0;
        foreach ($orderrequestitems as $k   => $item) {
            $item_arr[$k]['item_id']                = $item->id;
            $item_arr[$k]['category_name']          = $item->category_name;
            $item_arr[$k]['door_name']              = $item->door_name;
            $item_arr[$k]['quantity']               = $item->quantity;
            $item_arr[$k]['price']                  = $item->price;
            $item_arr[$k]['discount_amount']        = $item->discount_amount;
            $item_arr[$k]['calculated_discount']    = $item->calculated_discount;
            $item_arr[$k]['discount_type']          = $item->discount_type;
            $item_arr[$k]['assemble_knock']         = $item->assemble_knock;
//            if(!empty($item->sub_total)){
//                $item_arr[$k]['sub_total']          = $item->sub_total;
//            }else{

            $item_arr[$k]['sub_total']          = (($item->price *  $item->quantity) - $item->calculated_discount);
            $sub_total                          += (($item->price *  $item->quantity) - $item->calculated_discount);
            //}


            $orderrequestitems              = DB::table('door_item_modifiers')->where('door_item_id', $item->id)->orderBy('id', 'ASC')->get();
            foreach ($orderrequestitems as $orderrequestitem){
                $key                        = $orderrequestitem->door_modifier_key;
                $item_arr[$k][$key]         = $orderrequestitem->door_modifier_value;
            }
        }


        //$orderRequest                       = OrderRequest::findOrFail($orRequestId);
        $orderRequestProducts       = DB::table('cart_items')->where('order_request_id', $orRequestId)->orderBy('id', 'ASC')->get();
        //dd($orderRequestProducts['items']);

        //echo $user->usertype;die;
        $shoppingCart               = $this->cartService->getUserCart($user->id);
        $cartView                   = $this->doorService->getDoorViewObjectsForCart($shoppingCart);
        $cartIgtems                 = $cartView->getDoorViewObjects();
        $expected_shipping_date     = $orderRequest->expected_shipping_date->format('m-d-Y');
        $address_id                 = $orderRequest->ship_to;



        // for dealer shows the address he added while placing order request
        $disti_address1            = DB::table('addresses')->where('id',$address_id)->get();
        $disti_addr211             = $disti_address1[0]->address??null;
        $shipping_add              = $disti_addr211;
        $disti_addr2112            = $disti_address1[0]->address2??null;

        $disti_city211             = $disti_address1[0]->city??null;
        $disti_pcode211            = $disti_address1[0]->postal_code??null;
        $disti_st211               = $disti_address1[0]->state??null;
        $addd_comp                 = $disti_addr211.' '.$disti_addr2112.' '.$disti_city211.' '.$disti_st211.' '.$disti_pcode211;


        $OrderRequestNote          = DB::table('order_request_notes')->where('order_request_id', $orRequestId)->get();
        $orderRequestmsgs          = DB::table('order_request_messages')->where('order_request_id', $orRequestId)->get();
        //dd($item_arr);

        return view('order.EditManufacturerView', [
            'orderRequest'          => $orderRequest,
            'status'                => \App\Models\Order\Status::all(),
            'user'                  => $user,
            'doorViewItems'         => $orderrequestitems,
            'item_arr'              => $item_arr,
            'shipping_address'      => $shipping_add,
            'OrderRequestNotes'     => $OrderRequestNote,
            'orderRequestmsgs'      => $orderRequestmsgs,
            'sub_total'             => $sub_total,
            'orderRequestProducts'  => $orderRequestProducts,
            'distiryAdd'            => $addd_comp,
            'expected_shipping_date' => $expected_shipping_date
        ]);
    }


    public function Editmanufacturerdetailprint($orRequestId){

        //die('sdfsf');

        $user                     = auth()->user();
        $user_id                  = $user->id;
        //$userContact                        = DB::table('user_contacts')->where('user_id', $user_id)->orderBy('id', 'ASC')->get()->toArray();

        //$userContact->ship_to;

        $disti_address            = DB::table('addresses')->where('user_id',$user_id)->get();
        //dd($disti_address);
        $disti_addr               = $disti_address[0]->address??null;
        $disti_addr2              = $disti_address[0]->address2??null;
        $disti_city               = $disti_address[0]->city??null;
        $disti_pcode              = $disti_address[0]->postal_code??null;
        $disti_st                 = $disti_address[0]->state??null;
        $addd_comp                = $disti_addr.' '.$disti_addr2.' '.$disti_city.' '.$disti_pcode.' '.$disti_st;

        $orderRequest                       = OrderRequest::findOrFail($orRequestId);
        $expected_shipping_date             = $orderRequest->expected_shipping_date->format('m-d-Y');

        $orderrequestitems                  = DB::table('door_items')->where('order_request_id', $orRequestId)->orderBy('id', 'ASC')->get();

        $item_arr = array();
        $sub_total= 0;
        foreach ($orderrequestitems as $k   => $item) {
            $item_arr[$k]['item_id']                = $item->id;
            $item_arr[$k]['category_name']          = $item->category_name;
            $item_arr[$k]['door_name']              = $item->door_name;
            $item_arr[$k]['quantity']               = $item->quantity;
            $item_arr[$k]['price']                  = $item->price;
            $item_arr[$k]['discount_amount']        = $item->discount_amount;
            $item_arr[$k]['calculated_discount']    = $item->calculated_discount;
            $item_arr[$k]['discount_type']          = $item->discount_type;
            $item_arr[$k]['assemble_knock']         = $item->assemble_knock;
//            if(!empty($item->sub_total)){
//                $item_arr[$k]['sub_total']          = $item->sub_total;
//            }else{

            $item_arr[$k]['sub_total']          = (($item->price *  $item->quantity) - $item->calculated_discount);
            $sub_total                          += (($item->price *  $item->quantity) - $item->calculated_discount);
            //}


            $orderrequestitems              = DB::table('door_item_modifiers')->where('door_item_id', $item->id)->orderBy('id', 'ASC')->get();
            foreach ($orderrequestitems as $orderrequestitem){
                $key                        = $orderrequestitem->door_modifier_key;
                $item_arr[$k][$key]         = $orderrequestitem->door_modifier_value;
            }
        }


        //$orderRequest                       = OrderRequest::findOrFail($orRequestId);
        $orderRequestProducts       = DB::table('cart_items')->where('order_request_id', $orRequestId)->orderBy('id', 'ASC')->get();
        //dd($orderRequestProducts['items']);

        //echo $user->usertype;die;
        $shoppingCart               = $this->cartService->getUserCart($user->id);
        $cartView                   = $this->doorService->getDoorViewObjectsForCart($shoppingCart);
        $cartIgtems                 = $cartView->getDoorViewObjects();
        //echo $orderRequest->ship_to;die;


        $expected_shipping_date     = $orderRequest->expected_shipping_date->format('m-d-Y');
        $address_id                 = $orderRequest->ship_to;



        // for dealer shows the address he added while placing order request
        $disti_address1            = DB::table('addresses')->where('id',$address_id)->get();
        $disti_addr211             = $disti_address1[0]->address??null;
        $shipping_add              = $disti_addr211;
        $disti_addr2112            = $disti_address1[0]->address2??null;

        $disti_city211             = $disti_address1[0]->city??null;
        $disti_pcode211            = $disti_address1[0]->postal_code??null;
        $disti_st211               = $disti_address1[0]->state??null;
        $addd_comp                 = $disti_addr211.' '.$disti_addr2112.' '.$disti_city211.' '.$disti_st211.' '.$disti_pcode211;


        $OrderRequestNote           = DB::table('order_request_notes')->where('order_request_id', $orRequestId)->get();
        $orderRequestmsgs           = DB::table('order_request_messages')->where('order_request_id', $orRequestId)->get();


        return view('order.EditManufacturerPrint', [
            'orderRequest'          => $orderRequest,
            'status'                => \App\Models\Order\Status::all(),
            'user'                  => $user,
            'doorViewItems'         => $orderrequestitems,
            'item_arr'              => $item_arr,
            'shipping_address'      => $shipping_add,
            'OrderRequestNotes'     => $OrderRequestNote,
            'orderRequestmsgs'      => $orderRequestmsgs,
            'sub_total'             => $sub_total,
            'orderRequestProducts'  => $orderRequestProducts,
            'distiryAdd'            => $addd_comp,
            'expected_shipping_date' => $expected_shipping_date
        ]);
    }



    // methods for the 3 level
    public function editManufacturereqconfirm($orReqId){

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        $order_req      = OrderRequest::findOrFail($orReqId);
        //$order_req_data = $order_req->toArray();
        //$request_type   = $order_req_data['request_type'];

        //dd($order_req->request_type == '3 level');


        //dd($order_req);
        if($order_req->request_type == '3 level') {
            //dd($order_req_data->toArray());

            $user = auth()->user();
            $user_tpe = $user->usertype;

            switch ($user_tpe) {
                case "manufacturer":
                    $status = '1014';
                    $current_level = 4;
                    break;
                case "distributor":
                    $status = '1015';
                    $current_level = 5;
                    break;
                default:// for direct dealer
                    $status = '1014';
                    $current_level = 4;
            }

            DB::table('order_requests')->where('id', $orReqId)->update([
                'status'        => $status,
                'current_level' => $current_level,
            ]);
            return redirect()->route('oview');
        }



        if($order_req->request_type == '2 level') {
            //manufacturere direct confirm
            //$order_req
            //$order = $this->orderService->requestUpdateOrder($order_req_data);

            $order                                  = new Order();
            $order->created_by_user_id              = auth()->user()->id;
            $order->original_order_request_user_id  = $order_req->user_id;
            $order->distributor_id                  = $order_req->distributor_id;
            $order->dealer_id                       = $order_req->dealer_id;
            $order->purchase_order_number           = $order_req->po_number;
            $order->required_shipping_date          = $order_req->expected_shipping_date;
            $order->total_order_amount              = $order_req->total;


            $order->add_disc_type                   = $order_req->add_disc_type;
            $order->add_disc_val	                = $order_req->add_disc_val;

            $order->add_disc_amt	                = $order_req->add_disc_amt;
            //$order->shipping_address	            = $order_req->shipping_address;
            $order->ship_to	                        = $order_req->ship_to;
            $order->shipping_fee		            = $order_req->shipping_fee;
            $order->shipping_instruction		    = $order_req->shipping_instruction;

            $order->mull_fee		                = $order_req->mull_fee;
            $order->save();
            $ordreR_od                              = $order->id;

            // time to move the order requests items
            $orderrequestitems                  = DB::table('door_items')->where('order_request_id', $orReqId)->get();

            foreach($orderrequestitems as $doorItem):

                $orderItem                      = new OrderItem();
                //$orderItem->order_id            = $order->id;
                $orderItem->order_id            = $ordreR_od;
                $orderItem->item                = $doorItem->door_name;
                $orderItem->prod_type           = $doorItem->category_name;
                $orderItem->door_type           = $doorItem->door_type_pretty_name;
                $orderItem->quantity            = $doorItem->quantity;
                $orderItem->unit_price          = $doorItem->price;

                $orderItem->discount_type       = $doorItem->discount_type;
                $orderItem->calculated_discount = $doorItem->calculated_discount;
                $orderItem->discount_amount     = $doorItem->discount_amount;

                // get records of door item modifiers
                $doorItemModifiers          = DB::table('door_item_modifiers')->where('door_item_id', $doorItem->id)->get();
                foreach ($doorItemModifiers as $modifier) :
                    if ($modifier->door_modifier_key == 'SIZE') {
                        $split = explode(' ', $modifier->door_modifier_value);
                        $orderItem->width = $split[0];
                        $orderItem->height = $split[1];
                    } else if ($modifier->door_modifier_key == 'COLOR') {
                        $orderItem->color_code = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'HANDLING') {
                        $orderItem->door_handling = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'HANDLE') {
                        $orderItem->handle = $modifier->door_modifier_value;
                    }  else if ($modifier->door_modifier_key == 'GLASS_OPTION') {
                        $orderItem->glass_material = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'GLASS_DEPTH') {
                        $orderItem->glass_thickness = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'FRAME') {
                        $orderItem->door_frame = $modifier->door_modifier_value;
                    }


                    else if ($modifier->door_modifier_key == 'DP_OPTION') {
                        $orderItem->dp_option              = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'BLIND_OPTION') {
                        $orderItem->blind_option    = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'GLASS_GRID') {
                        $orderItem->glass_grid      = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'LITE_OPTION') {
                        $orderItem->lite_option = $modifier->door_modifier_value;

                    } else if ($modifier->door_modifier_key == 'LOCK') {
                        $orderItem->lock_option = $modifier->door_modifier_value;

                    } else if ($modifier->door_modifier_key == 'HANDLE') {
                        $orderItem->handle = $modifier->door_modifier_value;

                    } else if ($modifier->door_modifier_key == 'FRAME_THICKNESS_OPTION') {
                        $orderItem->frame_thickness = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'SILL_OPTION') {
                        $orderItem->sill_option = $modifier->door_modifier_value;
                    }else if ($modifier->door_modifier_key == 'SCREEN_OPTION') {
                        $orderItem->screen_option = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'HANDLE_COLOR_OPTION') {
                        $orderItem->handle_color = $modifier->door_modifier_value;

                    } else if ($modifier->door_modifier_key == 'LOCK_COLOR_OPTION') {
                        $orderItem->lock_color = $modifier->door_modifier_value;
                    } else if ($modifier->door_modifier_key == 'SILL_COLOR_OPTION') {
                        $orderItem->sill_color = $modifier->door_modifier_value;

                    } else if ($modifier->door_modifier_key == 'HINGE_COLOR_OPTION') {
                        $orderItem->hinge_color = $modifier->door_modifier_value;
                    }


                    $orderItem->save();
                endforeach;
            endforeach;

            // UPDATE THE FIELD ORDER ID
            DB::table('door_items')->where('order_request_id', $orReqId)->update([
                'order_id'        => $ordreR_od
            ]);

            //order_requests
            // NOTE :DONT delete the order_request just change the status
            if ($order != null && $order->id > 0) {
                //$order_req->delete();
                DB::table('order_requests')->where('id', $orReqId)->delete();
            }
            return redirect()->route('oview', ['oId' => $ordreR_od]);
        }


        die("Nothing Nothing");
    }


    // distributor can confirm request
    public function Distributor_request_update ( $status , $orReqId){

        //echo $status .',' .$orReqId;die;
        /*if($status == 'accept'){
            // make entry in the orders table
            $orderRequest   = OrderRequest::findOrFail($orReqId);



            $order                      = new Order();
            $order->created_by_user_id              = auth()->user()->id;
            $order->original_order_request_user_id  = $orderRequest->user_id;
            $order->distributor_id                  = $orderRequest->distributor_id;
            $order->dealer_id                       = $orderRequest->dealer_id;
            $order->purchase_order_number           = $orderRequest->po_number;
            $order->required_shipping_date          = $orderRequest->expected_shipping_date;
            $order->total_order_amount		        = $orderRequest->total;
            $order->freight_term		            = $orderRequest->freight_term;
            $order->transportation_mode			    = $orderRequest->transportation_mode;
            $order->ship_to			                = $orderRequest->ship_to;
            $order->save();



            echo '<pre>';
            var_dump($orderRequest);
            echo '</pre>';
            die;




            $order          = $this->orderService->createOrder($orderRequest);


            //echo  $order->id;die;
//            if ($order != null && $order->id > 0) {
//                //$orderRequest->delete();
//            }

        }else{
            // no entry in db table just reject
            DB::table('order_requests')->where('id', $orReqId)->update([
                'status'                 => 1017,
            ]);
        //}

        return redirect()->route('oview');


        //$orderRequest = OrderRequest::findOrFail();
        //$orderRequest->update(['status' => 1015]);
        */
    }



    public function showManufOrderRequests()
    {
        $user = auth()->user();

        $orderRequests = OrderRequest::all();

        return view('orderrequest.manufview',
            ['oRs' => $orderRequests,
                'status' => Status::all()]);
    }

    public function submitOrderRequest($orId)
    {
        $user = auth()->user();

        if ($user->hasPermission('u_order_request')) {

            $orderRequest = OrderRequest::findOrFail($orId);

            $orderRequest->update(['status' => 1002]);
        } else {
            request()->session()->put('message', 'Only users with ability to update orders are allowed to submit order requests.');
        }

        return redirect()->route('oview');
    }

    public function confirmOrderRequest($orId)
    {
        //echo $orId;die;
        $or         = OrderRequest::findOrFail($orId);

        //dd($or->doorItems);
        $orOwner    = User::FindOrFail($or->user_id);
        $orderDist  = User::find($or->distributor_id);

        $count = 0;
        foreach ($or->doorItems as $di) {
            $count++;
        }
        //echo $count.'sdfsf';die;


        return view('order.confirmation.stepone', ['or' => $or,
            'or_owner' => $orOwner->email,
            'or_dist' => $orderDist,
            'item_count' => $count]);
    }

    public function confirmStepOne($orId)
    {
        $orderRequest = OrderRequest::findOrFail($orId);
        $order = '';
        $user = auth()->user();
        //dd('sdfsf');

        if ($user->hasPermission('c_order')) {

            $orderRequest = OrderRequest::findOrFail($orId);
            $order = $this->orderService->createOrder($orderRequest);

            if ($order != null && $order->id > 0) {
                $orderRequest->delete();
            }

            return redirect()->route('oview', ['oId' => $order->id]);
        }

        $_SESSION['message'] = 'Only users with the permission "Create Order" are allowed to convert an order request.';

        if ($user->hasPermission('u_order_request')) {
            return redirect()->route('oview');
        } else {
            return redirect()->route('dashboard');
        }
    }

    private function loadSessionMessages($session)
    {
        $message = $session->get('message');
        $session->forget('message');

        return $message;
    }



    // methods for the 3 level
    public function manufacturerReqconfirm(){
        $data           = request()->validate([
            'order_request_id' => 'required',
        ]);

        $orReqId            = $data['order_request_id'];
        OrderRequest::findOrFail($orReqId);

        DB::table('order_requests')->where('id', $orReqId)->update([
            'status'        => 1011,
            'current_level' => 3,
        ]);
        return redirect()->route('oview');
    }


    //confirm order request
    public function orderReqconfirm($orId){

        $orderRequest   = OrderRequest::findOrFail($orId);
        //$order          = '';
        $user           = auth()->user();

        if ($user->hasPermission('c_order')) {
            $orderRequest   = OrderRequest::findOrFail($orId);
            $order          = $this->orderService->createOrder($orderRequest);

            if ($order != null && $order->id > 0) {
                $orderRequest->delete();
            }
            return redirect()->route('oview', ['oId' => $order->id]);
        }

        $_SESSION['message'] = 'Only users with the permission "Create Order" are allowed to convert an order request.';

        if ($user->hasPermission('u_order_request')) {
            return redirect()->route('oview');
        } else {
            return redirect()->route('dashboard');
        }
    }


    public function rejectOrderrequest($orId){
        $orderRequest = OrderRequest::findOrFail($orId);
        $orderRequest->update(['status' => 1017]);
        return redirect()->route('oview');
    }



    public function Editmanufacturerreq_bkkk_crect_three_levl(){


        $user                   = auth()->user();
        $data                   = request()->all();
        $order_request_Id       = $data['order_request_id'];

        $orderReq_data          = OrderRequest::findOrFail($order_request_Id);

        $req_generator_type     = $data['req_generator_type'];
        $request_type           = $data['request_type'];
        $current_level          = $data['current_level'];
        $shipping_fee           = $data['shipping_fee'];
        $freight_term           = $data['freight_term'];
        $transportation_mode    = $data['transportation_mode'];
        $shipping_instruction   = $data['shipping_instruction'];
        //$shipping_address       = $data['shipping_address'];
        $package_instruction    = $data['package_instruction'];
        $total                  = $data['total'];

        // manufacturer edit
        if (
            ($request_type == '3 level' && $current_level == '3'  && $user->usertype == 'manufacturer')  or
            ($request_type == '3 level' && $current_level == '4'  && $user->usertype == 'distributor') or
            ($request_type == '3 level' && $current_level == '5'  && $user->usertype == 'dealer') or
            ($request_type == '2 level' && $current_level == '2' && $user->usertype == 'manufacturer')
        ) {
            //$po_number              = $data['po_number'];

            if (array_key_exists('add_disc_type', $data)) {
                $add_disc_val   = $data['add_disc_val'];
                $add_disc_amt   = $data['add_disc_amt'];
                $add_disc_type  = $data['add_disc_type'];
            } else {
                $add_disc_type  = '';
                $add_disc_val   = 0;
                $add_disc_amt   = 0;
            }

            if (array_key_exists('add_sel', $data)) {
                $shipping_add = $data['add_sel'];

                // for the address
                if ($shipping_add == 'Own') {
                    // get the user address id and save it in order request table
                    $user_add_pbj = json_decode($user->address, true);
                    $ship_to = $user_add_pbj['id'];
                    DB::table('order_requests')->where('id', $order_request_Id)->update([
                        'ship_to' => $ship_to,
                        'shipping_address' => $shipping_add,
                    ]);
                }

                if ($shipping_add == 'Drop Shipping') {
                    // make entry of address and save its ref
                    //Address::create([
                    $ship_to = DB::table('addresses')->insertGetId([
                        'address' => $data['dropshipadd'],
                        'state' => $data['state'],
                        'city' => $data['city'],
                        'postal_code' => $data['zip']
                    ]);
                    DB::table('order_requests')->where('id', $order_request_Id)->update([
                        'ship_to' => $ship_to,
                        'shipping_address' => $shipping_add
                    ]);
                }
            }


            // check order request type  nd set status
            //if ($req_generator_type == 'dealer') {$status = 1014;} else {$status = 1013;}

            //$orderRequest           = OrderRequest::findOrFail($order_request_Id);
            if($request_type == '2 level' && $current_level == '2' && $user->usertype == 'manufacturer'){
                $status = 1008;
                $current_level = 3;
            }else{
                $status         = $orderReq_data->status;
                $current_level  = $orderReq_data->$current_level;

            }

            DB::table('order_requests')->where('id', $order_request_Id)->update([
                //'status'        => $status,
                'add_disc_type'         => $add_disc_type,
                'add_disc_amt'          => $add_disc_amt,
                'add_disc_val'          => $add_disc_val,
                'freight_term'          => $freight_term,
                'transportation_mode'   => $transportation_mode,
                'shipping_instruction'  => $shipping_instruction,
                'package_instruction'   => $package_instruction,
                'shipping_fee'          => $shipping_fee,
                'total' => $total

                //'po_number'              => $po_number,
                //'shipping_address'       => $shipping_address
            ]);

            if (array_key_exists('order_note', $data)) {
                $order_note = $data['order_note'];
                if (!empty($order_note)) {
                    OrderRequestNote::create([
                        'order_note' => $order_note,
                        'user_id' => $user->id,
                        'order_request_id' => $order_request_Id
                    ]);
                }
            }

            if (array_key_exists('message', $data)) {
                $message = $data['message'];
                if (!empty($message)) {
                    OrderRequestMessage::create([
                        'message' => $message,
                        'user_id' => $user->id,
                        'order_request_id' => $order_request_Id
                    ]);
                }
            }

            foreach ($data['items'] as $kkk => $item_id) {

                DB::table('door_items')->where('id', $item_id)->update([
                    'discount_type' => $data['discount_type'][$kkk],
                    'discount_amount' => $data['discount_amount'][$kkk],
                    'calculated_discount' => $data['calculated_discount'][$kkk],
                    'sub_total' => $data['sub_total'][$kkk]
                ]);
            }
            //dd('sdsdssdsad');
            //return redirect()->action('OrderController@showOrders');
            return redirect()->route('oview');
        }else{
            return redirect()->route('oview');
        }
    }

}
