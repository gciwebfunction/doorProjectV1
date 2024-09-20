<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Constants;
use App\Models\Distributor;
use App\Models\DirectDealer;
use App\Models\UserContact;


use App\Models\Manufacturer;
use App\Models\User;
use App\Providers\UserProvider;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Password;
use Session;
use DB;


class DetailedUserController extends Controller
{

    public function __construct()
    {
        $usStates = Constants::getStates();
        View::share('usStates', $usStates);

        $this->middleware(['groups:manuf-grp']);
    }

    public function view()
    {
        $users = User::orderby('created_at', 'asc')->get();

        foreach ($users as $user) {
            $user->user_type = UserProvider::getUserType($user);
        }

        return view('user.view',
            ['detailedusers' => $users]
        );
    }

    public function show($id)
    {
        $user               = User::findOrFail($id);
        $user->user_type    = UserProvider::getUserType($user);

        $phyAsDd            = UserContact::where('user_id', $user->id)->get();
        //dd($phyAsDd);
        $physical_addressid = $phyAsDd[0]['physical_address_id'];


        //$distributors       = User::join('distributors', 'distributors.user_id', '=', 'users.id')->where(['usertype' => 'distributor', 'users.disabled' => '0'])->select('distributors.*')->get();

        $distributors      = User::where('usertype', 'distributor')->get();
//dd($distributors);
        $manufacturers      = User::where('usertype', 'manufacturer')->get();
        if (empty($user->address)) {
            $user->address = new Address();
        }
        //$distributors = Distributor::where('user_id', $user->id)->get();
        //echo '<pre>'; var_dump($distributors ); die;

        if($user->user_type == 'distributor'){
                    // $distributors = Distributor::where('user_id', $user->id)->get();
                    // if (empty($distributors[0])) {
                    // $distributors[0] = new Distributor();
                    // }
             $distributors = UserContact::where('user_id', $user->id)->get();
             //dd($distributors);
            $physiaclAddres       = Address::where('id', $physical_addressid)->get();

            return view('user.viewone',
                [
                    'user_type'         => $user->user_type,
                    'usermodel'         => $user,
                    'contactinfo'       => $distributors[0],
                    'manufacturers'     => $manufacturers,
                    'physiaclAddres' => $physiaclAddres
                ]
            );

        }else if($user->user_type == 'direct_dealer' || $user->user_type == 'dealer'){

                //$distributors = UserContact::where('user_id', $user->id)->get();
                //if (empty($distributors[0])) {
                   // $distributors[0] = new Distributor();
                //}
                //dd($user);
            $physiaclAddres         = Address::where('id', $physical_addressid)->get();
            $distributor           = UserContact::where('user_id', $user->id)->get();
                return view('user.viewone',
                    [
                        'user_type'         => $user->user_type,
                        'usermodel' => $user,
                        'contactinfo' => $distributor[0],
                        'manufacturers' => $manufacturers,
                        'physiaclAddres' => $physiaclAddres,
                        'distributors' => $distributors
                    ]
                );
        }
        else{

            //$distributor = Distributor::where('user_id', $user->id)->get();
            $distributor = UserContact::where('user_id', $user->id)->get();

            if (empty($distributor[0])) {
                $distributor[0] = new Distributor();
            }

            //echo '<pre>'; var_dump($distributor); echo '</pre>'; die;

            return view('user.viewone',
                [
                    'user_type'         => $user->user_type,
                    'usermodel'         => $user,
                    'contactinfo'       => $distributor[0],
                    'distributors'      => $distributors,
                    'manufacturers'     => $manufacturers,
                ]
            );
        }
    }

    public function create()
    {

        $user = auth()->user();

        //dd($user->usertype);
        return view('user.create', [
                'user_own_type' => $user->usertype,
                'distributors' => User::where([
                    ['disabled', '=', '0'],
                    ['usertype', '=', 'distributor'],
                ])->get(),
                'manufactureres' => User::where([
                    ['disabled', '=', '0'],
                    ['usertype', '=', 'manufacturer'],
                ])->get(),
            ]
        );
        /*$distributors = User::join('distributors', 'distributors.user_id', '=', 'users.id')->where(['usertype' => 'distributor', 'users.disabled' => '0'])->select('distributors.*')->get();
        return view('user.create', ['distributors' => $distributors]);*/
    }

    public function store()
    {
        $data = request()->all();
        //echo $data['selectedUserType'];die;
        //dd($data);

        switch ($data['selectedUserType']) {
            case 'distributor':
                //echo 'mango1';
                $data                       = request()->validate([
                    'email'                 => 'required|unique:users',
                    'name'                  => 'required',
                    'existingUserId'        => '',

                    'distributorName'       => '',
                    'contactPerson'         => '',

                    'contactPerson2'        => '',
                    'contactPersonPhone'    => '',
                    'contactPersonPhone2'   => '',
                    'address'               => 'required',
                    'address2'              => '',
                    'inputCity'             => 'required',
                    'state'                 => 'required',
                    'inputZip'              => 'required',

                    'physical_address'      => 'required',
                    'physical_address2'     => '',
                    'physical_city'         => 'required',
                    'physical_state'        => 'required',
                    'physical_zip'          => 'required',
                    
                    'credit_limit'          => '',
                    'payment_term'          => '',
                    'primary_fax'           => '',
                    'secondary_fax'         => '',

                    'password'              => [
                            'required',
                            'confirmed',
                            'min:10',             // must be at least 10 characters in length
                            'regex:/[a-z]/',      // must contain at least one lowercase letter
                            'regex:/[A-Z]/',      // must contain at least one uppercase letter
                            'regex:/[0-9]/',      // must contain at least one digit
                            'regex:/[@$!%*#?&]/', // must contain a special character
                    ],
                    'passwordConfirm'       => '',
                    'selectedUserType'      => 'required',
                ]);
                break;

            case 'sales' :

                $data = request()->validate([
                    'email'                 => 'required|unique:users',
                    'name'                  => 'required',
                    'selectedDistributor'   => '',
                    'selectedManufacturer'  => '',
                    'distributorName'       => '',
                    'contactPerson'         => '',
                    'contactPerson2'        => '',
                    'contactPersonPhone'    => '',
                    'contactPersonPhone2'   => '',

                    'address'       => '',
                    'address2'      => '',
                    'inputCity'     => '',
                    'state'         => '',
                    'inputZip'      => '',

                    //'address' => 'required',
                    //'address2' => '',
                    //'inputCity' => 'required',
                    //'state' => 'required',
                    //'inputZip' => 'required',

                    'password' => ['required', 'confirmed', Password::min(8)],
                    'passwordConfirm' => '',
                    'selectedUserType' => 'required',
                ]);
                break;
            case 'sales_manager' :
                //echo 'mangoSM'; die;
                $data = request()->validate([
                    'email'                 => 'required|unique:users',
                    'name'                  => 'required',
                    'selectedDistributor'   => '',
                    'selectedManufacturer'  => '',
                    'distributorName'       => '',
                    'contactPerson'         => '',
                    'contactPerson2'        => '',
                    'contactPersonPhone'    => '',
                    'contactPersonPhone2'   => '',
                    'address'               => '',
                    'address2'              => '',
                    'inputCity'             => '',
                    'state'                 => '',
                    'inputZip'              => '',


                    //'address' => 'required',
                    //'address2' => '',
                    //'inputCity' => 'required',
                    //'state' => 'required',
                    //'inputZip' => 'required',

                    'password' => ['required', 'confirmed', Password::min(8)],
                    'passwordConfirm' => '',
                    'selectedUserType' => 'required',
                ]);
                break;
            case 'manufacturer':
                //echo 'mangoM'; die;
                $data = request()->validate([
                    'email' => 'required|unique:users',
                    'name' => 'required',
                    'existingUserId' => '',
                    'distributorName' => '',
                    'contactPerson' => '',
                    'contactPerson2' => '',
                    'contactPersonPhone' => '',
                    'contactPersonPhone2' => '',
                    'address' => 'required',
                    'address2' => '',
                    'inputCity' => 'required',
                    'state' => 'required',
                    'inputZip' => 'required',
                    'password' => ['required', 'confirmed', Password::min(8)],
                    'passwordConfirm' => '',
                    'selectedUserType' => 'required',
                ]);
                break;
            case 'dealer':
                //echo 'mango3'; die;
                $data                       = request()->validate([
                    'email'                 => 'required|unique:users',
                    'name'                  => 'required',
                    'existingUserId'        => '',
                    'distributorName'       => '',
                    'distributor_id'        => 'required',
                    'contactPerson'         => '',
                    'contactPerson2'        => '',
                    'contactPersonPhone'    => '',
                    'contactPersonPhone2'   => '',
                    'address'               => 'required',
                    'address2'              => '',
                    'inputCity'             => 'required',
                    'state'                 => 'required',
                    'inputZip'              => 'required',
                    'password'              => ['required', 'confirmed', Password::min(8)],
                    'passwordConfirm'       => '',
                    'selectedUserType'      => 'required',
                    'credit_limit'          => '',
                    'payment_term'          => '',
                    'primary_fax'           => '',
                    'secondary_fax'         => '',

                    'physical_address'      => 'required',
                    'physical_address2'     => '',
                    'physical_city'         => 'required',
                    'physical_state'        => 'required',
                    'physical_zip'          => 'required',

                    //'associated_manufacturer'      => '',
                ]);
                break;

            case 'direct_dealer':
                //echo 'mangoM'; die;
                $data = request()->validate([
                    'email' => 'required|unique:users',
                    'name' => 'required',
                    'existingUserId' => '',
                    'distributorName' => '',
                    //'contactPerson' => 'required',
                    'contactPerson' => '',
                    'contactPerson2' => '',
                    'contactPersonPhone' => '',
                    'contactPersonPhone2' => '',
                    'address' => 'required',
                    'address2' => '',
                    'inputCity' => 'required',
                    'state' => 'required',
                    'inputZip' => 'required',
                    'password' => ['required', 'confirmed', Password::min(8)],
                    'passwordConfirm' => '',
                    'selectedUserType' => 'required',


                    'credit_limit'          => '',
                    'payment_term'          => '',
                    'primary_fax'           => '',
                    'secondary_fax'         => '',

                    'physical_address'      => 'required',
                    'physical_address2'     => '',
                    'physical_city'         => 'required',
                    'physical_state'        => 'required',
                    'physical_zip'          => 'required',


                ]);
                break;

            default:
                break;
        }

        //dd($data);
        $this->storeOrCreateUser($data);

        $users = User::orderby('created_at', 'asc')->get();
        Session::flash('success', 'Successfully Added / Updated ');
        return view('user.view',
            ['detailedusers' => $users,
            ]
        );
    }

    public function update()
    {


        $data = request()->all();
        //echo $data['selectedUserType'];die;
        //dd($data);

        switch ($data['selectedUserType']) {
            case 'distributor':
                //echo 'mango1';
                $data                       = request()->validate([
//                    'email'                 => 'required|unique:users',
                    'existingUserId'        => 'required',
                    'name'                  => 'required',
                    'selectedUserType'      => 'required',
                    'existingUserId'        => '',
                    'distributorName'       => '',
                    'contactPerson'         => '',
                    'contactPerson2'        => '',
                    'contactPersonPhone'    => '',
                    'contactPersonPhone2'   => '',
                    'address'               => 'required',
                    'address2'              => '',
                    'inputCity'             => 'required',
                    'state'                 => 'required',
                    'inputZip'              => 'required',
                    'physical_address'      => 'required',
                    'physical_address2'     => '',
                    'physical_city'         => 'required',
                    'physical_state'        => 'required',
                    'physical_zip'          => 'required',

                    'credit_limit'          => '',
                    'payment_term'          => '',
                    'primary_fax'           => '',
                    'secondary_fax'         => '',

                    'password'              => [
                        'required',
//                        'confirmed',
                        'min:10',             // must be at least 10 characters in length
                        'regex:/[a-z]/',      // must contain at least one lowercase letter
                        'regex:/[A-Z]/',      // must contain at least one uppercase letter
                        'regex:/[0-9]/',      // must contain at least one digit
                        'regex:/[@$!%*#?&]/', // must contain a special character
                    ],


                ]);
                break;

            case 'sales' :

                $data = request()->validate([

                    'name'                  => 'required',
                    'selectedDistributor'   => '',
                    'selectedManufacturer'  => '',
                    'distributorName'       => '',
                    'contactPerson'         => '',
                    'contactPerson2'        => '',
                    'contactPersonPhone'    => '',
                    'contactPersonPhone2'   => '',
                    'existingUserId'        => 'required',


                    'address'       => '',
                    'address2'      => '',
                    'inputCity'     => '',
                    'state'         => '',
                    'inputZip'      => '',

                    //'address' => 'required',
                    //'address2' => '',
                    //'inputCity' => 'required',
                    //'state' => 'required',
                    //'inputZip' => 'required',

                    'password' => ['required', Password::min(8)],
                    //'passwordConfirm' => '',
                    'selectedUserType' => 'required',
                ]);
                break;
            case 'sales_manager' :
                //echo 'mangoSM'; die;
                $data = request()->validate([

                    'name' => 'required',
                    'selectedDistributor' => '',
                    'selectedManufacturer' => '',
                    'distributorName' => '',
                    'contactPerson' => '',
                    'contactPerson2' => '',
                    'contactPersonPhone' => '',
                    'contactPersonPhone2' => '',
                    'address'       => '',
                    'address2'      => '',
                    'inputCity'     => '',
                    'state'         => '',
                    'inputZip'      => '',
                    'existingUserId'        => 'required',

                    //'address' => 'required',
                    //'address2' => '',
                    //'inputCity' => 'required',
                    //'state' => 'required',
                    //'inputZip' => 'required',

                    'password' => ['required',  Password::min(8)],
                    //'passwordConfirm' => '',
                    'selectedUserType' => 'required',
                ]);
                break;
            case 'manufacturer':
                //echo 'mangoM'; die;

                $data = request()->validate([

                    'name' => 'required',
                    'existingUserId'        => 'required',
                    'distributorName' => '',
                    'contactPerson' => '',
                    'contactPerson2' => '',
                    'contactPersonPhone' => '',
                    'contactPersonPhone2' => '',
                    'address' => 'required',
                    'address2' => '',
                    'inputCity' => 'required',
                    'state' => 'required',
                    'inputZip' => 'required',
                    //'password' => ['required', 'confirmed', Password::min(8)],
                    'password' => ['required', Password::min(8)],
                    'passwordConfirm' => '',
                    //'selectedUserType' => 'required',
                ]);
                break;
            case 'dealer':
                //echo 'mango3'; die;
                $data                       = request()->validate([

                    'name'                  => 'required',
                    'existingUserId'        => '',
                    'distributorName'       => '',
                    'distributor_id'        => 'required',
                    'contactPerson'         => '',
                    'contactPerson2'        => '',
                    'contactPersonPhone'    => '',
                    'contactPersonPhone2'   => '',
                    'address'               => 'required',
                    'address2'              => '',
                    'inputCity'             => 'required',
                    'state'                 => 'required',
                    'inputZip'              => 'required',
                    'password'              => ['required',  Password::min(8)],
                    'passwordConfirm'       => '',
                    'selectedUserType'      => 'required',
                    'credit_limit'          => '',
                    'payment_term'          => '',
                    'primary_fax'           => '',
                    'secondary_fax'         => '',

                    'physical_address'      => 'required',
                    'physical_address2'     => '',
                    'physical_city'         => 'required',
                    'physical_state'        => 'required',
                    'physical_zip'          => 'required',
                    'selectedUserType'      => 'required',

                    //'associated_manufacturer'      => '',
                ]);
                break;

            case 'direct_dealer':
                //echo 'mangoM'; die;
                $data = request()->validate([

                    'name' => 'required',
                    'existingUserId' => '',
                    'distributorName' => '',
                    'contactPerson' => '',
                    'contactPerson2' => '',
                    'contactPersonPhone' => '',
                    'contactPersonPhone2' => '',
                    'address' => 'required',
                    'address2' => '',
                    'inputCity' => 'required',
                    'state' => 'required',
                    'inputZip' => 'required',
                    'password' => ['required', Password::min(8)],

                    //'selectedUserType' => 'required',


                    'credit_limit'          => '',
                    'payment_term'          => '',
                    'primary_fax'           => '',
                    'secondary_fax'         => '',

                    'physical_address'      => 'required',
                    'physical_address2'     => '',
                    'physical_city'         => 'required',
                    'physical_state'        => 'required',
                    'physical_zip'          => 'required',
                    'selectedUserType'      => 'required',


                ]);
                break;

            default:
                break;
        }

        //dd($data);
        $this->storeOrCreateUser($data);

        $users = User::orderby('created_at', 'asc')->get();

        Session::flash('success', 'User Created / Updated');
        return redirect()->route('uview');

        // return view('user.view', ['detailedusers' => $users] );
    }

    /**
     * Enable or disable a user.
     *
     * @param $id
     * @return void
     */
    public function toggle($id)
    {
        $user = auth()->user();
        if ($user->id == $id) {
            return back()->with('error', 'You cannot disable your own account!!!');
        }

        $targetedUser = User::findOrFail($id);
        if ($targetedUser->disabled) {
            $targetedUser->update(['disabled' => false]);
        } else {
            $targetedUser->update(['disabled' => true]);
        }

        return back()->with('success', $targetedUser->email . ' account updated!');
    }

    private function storeOrCreateUser(array $data)
    {


        // for the sales manager code
        /*if($data['selectedUserType'] ==  'sales_manager'){

        }else{*/

            $auser      = '';
            $address    = '';

        //echo $data['existingUserId'];
        //$this->authorize('update', $existingUser);

        if (array_key_exists('existingUserId', $data)) {


                $auser                  = User::findOrFail($data['existingUserId']);
                $auser->update([
                        'name'          => $data['name'],
                        'password'      => Hash::make($data['password'])
                ]);

                $UserConArray           = UserContact::where('user_id', $data['existingUserId'])->get();

                $primary_fax            = isset($data['primary_fax'])   ?   $data['primary_fax']    : 0;
                $secondary_fax          = isset($data['secondary_fax']) ?   $data['secondary_fax']  : 0;
                $credit_limit           = isset($data['credit_limit'])  ?   $data['credit_limit']   : 0;
                $payment_term           = isset($data['payment_term'])  ?   $data['payment_term']   : 0;

                $distributorName        = isset($data['distributorName']) ? $data['distributorName'] : null;
                $contactPerson          = isset($data['contactPerson']) ? $data['contactPerson'] : null;
                $contactPersonPhone     = isset($data['contactPersonPhone']) ? $data['contactPersonPhone'] : null;
                $contactPerson2         = isset($data['contactPerson2']) ? $data['contactPerson2'] : null;


            // update the user contact
                if (sizeof($UserConArray) > 0) {
                    // apply condition for the  update too over here
                    DB::table('user_contacts')->where('user_id', $auser->id)->update([
                        'distributor_name'      => $distributorName,
                        'primary_contact'       => $contactPerson,
                        'primary_phone'         => $contactPersonPhone,
                        'secondary_contact'     => $contactPerson2,
                        //'shipping_address_id'   => 0, //'physical_address_id'   => 0,
                    ]);

                }else{
                    UserContact::create([
                        'user_id'               => $auser->id,
                        'distributor_name'      => $distributorName,
                        'primary_contact'       => $contactPerson,
                        'primary_phone'         => $contactPersonPhone,
                        'secondary_contact'     => $contactPerson2,
                        //'credit_limit'          => $credit_limit,
                        //'payment_term'          => $payment_term,
                       //'primary_fax'           => $primary_fax,
                       //'secondary_fax'         => $secondary_fax,
                    ]);
                }

                if($data['selectedUserType'] == 'distributor' or  $data['selectedUserType'] == 'direct_dealer' or  $data['selectedUserType'] == 'dealer') {

                    // shipping address logic starts
                    if (isset($UserConArray[0]['shipping_address_id']) && $UserConArray[0]['shipping_address_id'] != 0) {

                        $addressArray = Address::where('user_id', $auser->id)
                            ->where('id', $UserConArray[0]['shipping_address_id'])
                            ->get();

                        if (sizeof($addressArray) >= 1) {

                            Address::where('user_id', $auser->id)
                                    ->where('id', $UserConArray[0]['shipping_address_id'])
                                    ->update([
                                        'address' => $data['address'],
                                        'address2' => $data['address2'],
                                        'city' => $data['inputCity'],
                                        'state' => $data['state'],
                                        'postal_code' => $data['inputZip'],
                                    ]);

                        }
                    } else {
                        //echo 'sdsdsd';die;
                        // make a new entry in shipping address
                        $address            = Address::create([
                            'user_id'       => $auser->id,
                            'address'       => $data['address'],
                            'address2'      => $data['address2'],
                            'city'          => $data['inputCity'],
                            'state'         => $data['state'],
                            'postal_code'   => $data['inputZip']
                        ]);

                        $shipping_address_id = $address->id; // Retrieve the inserted ID
                        DB::table('user_contacts')->where('user_id', $auser->id)->update(['shipping_address_id' => $shipping_address_id]);
                    }
                    // shipping address logic ends


                    // physical address logic starts
                    if (isset( $UserConArray[0]['physical_address_id']) &&  $UserConArray[0]['physical_address_id'] != 0) {

                        $addressArray = Address::where('user_id', $auser->id)
                            ->where('id',  $UserConArray[0]['physical_address_id'])
                            ->get();

                        if (sizeof($addressArray) >= 1) {
                            Address::where('user_id', $auser->id)
                                ->where('id',  $UserConArray[0]['physical_address_id'])
                                ->update([
                                        'address'       => $data['physical_address'],
                                        'address2'      => $data['physical_address2'],
                                        'city'          => $data['physical_city'],
                                        'state'         => $data['physical_state'],
                                        'postal_code'   => $data['physical_zip'],
                                    ]);

                        }
                    } else {
                        // make a new entry in shipping address
                        $addressP = Address::create([
                            'user_id'       => $auser->id,
                            'address'       => $data['physical_address'],
                            'address2'      => $data['physical_address2'],
                            'city'          => $data['physical_city'],
                            'state'         => $data['physical_state'],
                            'postal_code'   => $data['physical_zip'],
                        ]);

                        $physical_address_id = $addressP->id; // Retrieve the inserted ID
                        DB::table('user_contacts')->where('user_id', $auser->id)->update(['physical_address_id' => $physical_address_id]);
                    }
                    // physical address logic ends
                }
        }
        else {

            //echo $data['distributorName'];die;
                $data['password']   = Hash::make($data['password']);


                if(isset($data['selectedManufacturer'])){
                    $selectedManufacturer = $data['selectedManufacturer'];
                }else{
                    $selectedManufacturer = -1;
                }
                //echo $selectedManufacturer;die;
                $data['associated_manufacturer']   = $selectedManufacturer;

                $auser                      = User::create($data);
                $UserConArray               = UserContact::where('user_id', $auser->id)->get();

                //echo 'sdfsfsf<pre>'; var_dump($UserConArray); echo '</pre>'; die;

                if (sizeof($UserConArray) > 0) {

                    $physical_address_id    = $UserConArray['physical_address_id'] != 0   ?   $UserConArray['physical_address_id']  : 0;
                    $shipping_address_id    = $UserConArray['shipping_address_id'] != 0   ?   $UserConArray['shipping_address_id']  : 0;
                }else{
                    $physical_address_id    = 0;
                    $shipping_address_id    = 0;
                }

                if($data['selectedUserType'] == 'distributor' or  $data['selectedUserType'] == 'direct_dealer' or  $data['selectedUserType'] == 'dealer') {


                    // for the shipping address
                    $addressArray = Address::where('user_id', $auser->id)->where('id', $shipping_address_id)->get();

                    // address part starts
                    if (sizeof($addressArray) > 0) {
                        $addressArray[0]->update([
                            'address' => $data['address'],
                            'address2' => $data['address2'],
                            'city' => $data['inputCity'],
                            'state' => $data['state'],
                            'postal_code' => $data['inputZip'],
                        ]);
                        $address = $addressArray[0];
                    } else {
                        $address = Address::create([
                            'user_id' => $auser->id,
                            'address' => $data['address'],
                            'address2' => $data['address2'],
                            'city' => $data['inputCity'],
                            'state' => $data['state'],
                            'postal_code' => $data['inputZip']
                        ]);
                    }
                    // address part ends

                    // for the physical address
                    $addressArrayPhy = Address::where('user_id', $auser->id)->where('id', $physical_address_id)->get();

                    if (sizeof($addressArrayPhy) > 0) {
                        $addressArrayPhy[0]->update([
                            'address' => $data['physical_address'],
                            'address2' => $data['physical_address2'],
                            'city' => $data['physical_city'],
                            'state' => $data['physical_state'],
                            'postal_code' => $data['physical_zip'],
                        ]);
                        $addressphy = $addressArrayPhy[0];
                    } else {
                        $addressphy = Address::create([
                            'user_id' => $auser->id,
                            'address' => $data['physical_address'],
                            'address2' => $data['physical_address2'],
                            'city' => $data['physical_city'],
                            'state' => $data['physical_state'],
                            'postal_code' => $data['physical_zip']
                        ]);
                    }
                }

                //$affectedRows = UserContact::where("id", 3)->update(["title" => "Updated title"]);

                $primary_fax    = isset($data['primary_fax'])   ?   $data['primary_fax']    : 0;
                $secondary_fax  = isset($data['secondary_fax']) ?   $data['secondary_fax']  : 0;
                $credit_limit   = isset($data['credit_limit'])  ?   $data['credit_limit']   : 0;
                $payment_term   = isset($data['payment_term'])  ?   $data['payment_term']   : 0;

                $addresS_idd    = isset($address->id)  ?   $address->id   : 0;
                $addresSphy_idd = isset($addressphy->id)  ?   $addressphy->id   : 0;

                // address part starts
                if (sizeof($UserConArray) > 0) {
                    // apply condition for the  update too over here

                    $UserConArray[0]->update([
                        'user_id'               => $auser->id,
                        'distributor_name'      => $data['distributorName'],
                        'shipping_address_id'   => $addresS_idd,
                        'physical_address_id'   => $addresSphy_idd,

                        'primary_contact'       => $data['contactPerson'],
                        'primary_phone'         => $data['contactPersonPhone'],
                        'secondary_contact'     => $data['contactPerson2'],

                        'credit_limit'          => $credit_limit,
                        'payment_term'          => $payment_term,
                        'primary_fax'           => $primary_fax,
                        'secondary_fax'         => $secondary_fax,
                    ]);
                }else{

                    UserContact::create([
                        'user_id'               => $auser->id,
                        'distributor_name'      => $data['distributorName'],
                        'shipping_address_id'   => $addresS_idd,
                        'physical_address_id'   => $addresSphy_idd,

                        'primary_contact'       => $data['contactPerson'],
                        'primary_phone'         => $data['contactPersonPhone'],
                        'secondary_contact'     => $data['contactPerson2'],

                        'credit_limit'          => $credit_limit,
                        'payment_term'          => $payment_term,
                        'primary_fax'           => $primary_fax,
                        'secondary_fax'         => $secondary_fax,
                    ]);
                   // die($data['distributorName']);
                }



            }

           /* if (isset($data['inputZip']) || isset($data['address'])
                || isset($data['address2']) || isset($data['inputCity'])
                || isset($data['state'])) {
                $addressArray = Address::where('user_id', $auser->id)->get();
                if (sizeof($addressArray) > 0) {
                    $addressArray[0]->update([
                        'address' => $data['address'],
                        'address2' => $data['address2'],
                        'city' => $data['inputCity'],
                        'state' => $data['state'],
                        'postal_code' => $data['inputZip'],
                    ]);
                    $address = $addressArray[0];
                } else {
                    $address = Address::create([
                        'user_id' => $auser->id,
                        'address' => $data['address'],
                        'address2' => $data['address2'],
                        'city' => $data['inputCity'],
                        'state' => $data['state'],
                        'postal_code' => $data['inputZip']
                    ]);
                }
            }*/

            if (array_key_exists('selectedUserType', $data)) {
                $auser->usertype = $data['selectedUserType'];
                $auser->save();

                $distributor = '';
                $distributorArray = UserContact::where('user_id', $auser->id)->get();



                if (empty($distributorArray[0])) {
//                    $distributor =
//                        UserContact::create([
//                            'user_id' => $auser->id,
//                            'distributor_name' => $data['distributorName'],
//                            'shipping_address_id' => $addresSphy_idd,
//                            'physical_address_id' => $addresS_idd,
//                            'credit_limit' => $credit_limit,
//                            'payment_term' => $payment_term,
//
//                            'primary_contact' => $data['contactPerson'],
//                            'primary_phone' => $data['contactPersonPhone'],
//                            'secondary_contact' => $data['contactPerson2'],
//                        ]);

                        // add the code for distributr

                } else {

                    //$distributor_id             = ($distributorArray[0]->id);
//                    DB::table('user_contacts')->where('id', $distributor_id)->update([
//                        'distributor_name'      => $data['distributorName'],
//                        'shipping_address_id'   => $address->id,
//                        'physiacl_address_id'   => $address->id,
//                    ]);
                }



                //if (isset($data['selectedManufacturer'])) {

                if($data['selectedUserType'] == 'distributor' or  $data['selectedUserType'] == 'direct_dealer' or  $data['selectedUserType'] == 'dealer') {
//                    if (isset($data['contactPerson'])) {
//                        if (!empty($distributor_id)) {
//                            DB::table('user_contacts')->where('id', $distributor_id)->update([
//                                'primary_contact' => $data['contactPerson'],
//                            ]);
//                        } else {
//                            DB::table('user_contacts')->where('user_id', $data['existingUserId'])->update([
//                                'primary_contact' => $data['contactPerson'],
//                            ]);
//                        }
//                    }

//                    if (isset($data['contactPerson2'])) {
//                        if(!empty($distributor_id)) {
//                            DB::table('user_contacts')->where('id', $distributor_id)->update([
//                                'secondary_contact' => $data['contactPerson2'],
//                            ]);
//                        }else{
//                            DB::table('user_contacts')->where('user_id', $data['existingUserId'])->update([
//                                'secondary_contact' => $data['contactPerson2'],
//                            ]);
//                        }
//                    }
//
//                    if (isset($data['contactPersonPhone2'])) {
//                        if(!empty($distributor_id)) {
//                            DB::table('user_contacts')->where('id', $distributor_id)->update([
//                                'secondary_phone' => $data['contactPersonPhone2'],
//                            ]);
//                        }else{
//                            DB::table('user_contacts')->where('user_id', $data['existingUserId'])->update([
//                                'secondary_phone' => $data['contactPersonPhone2'],
//                            ]);
//                        }
//                    }

                }

//                        if (isset($data['contactPersonPhone'])) {
//                            if(!empty($distributor_id)) {
//                                DB::table('user_contacts')->where('id', $distributor_id)->update([
//                                    'primary_phone' => $data['contactPersonPhone'],
//                                ]);
//                            }else{
//                                DB::table('user_contacts')->where('user_id', $data['existingUserId'])->update([
//                                    'primary_phone' => $data['contactPersonPhone'],
//                                ]);
//                            }
//                        }




                //dd($data['selectedUserType']);
                switch ($data['selectedUserType']) {

                    case 'distributor':
                        $auser->assignGroup(['distributor-grp']);
                        break;
                    case 'direct_dealer':
                        $auser->assignGroup(['direct-dealer-grp']);
                        break;
                    case 'sales_manager':
                       // die('asdad');
                        $auser->assignGroup(['slsmgr-grp']);
                        if(isset($data['selectedManufacturer']))
                            $auser->update(['associated_manufacturer' => $data['selectedManufacturer']]);
                        break;
                    case 'sales':
                        $auser->assignGroup(['sales-grp']);
                        if(isset($data['selectedManufacturer']))
                            $auser->update(['associated_manufacturer' => $data['selectedManufacturer']]);
                        break;
                    case 'dealer':
                        $auser->assignGroup(['dealer-grp']);
                        if(isset($data['selectedDistributor']))
                            $auser->update(['distributor_id' => $data['selectedDistributor']]);
                        break;

                }
            }
       // }

    }

    // useing distributor table
    private function storeOrCreateUser_bkkk(array $data)
    {

        $auser = '';
        $address = '';

        if (array_key_exists('existingUserId', $data)) {
            $auser = User::findOrFail($data['existingUserId']);
            //$this->authorize('update', $existingUser);
            $auser->update(
                ['name' => $data['name'],
                ]);
        } else {
            $data['password'] = Hash::make($data['password']);
            $auser = User::create($data);
        }

        if (isset($data['inputZip']) || isset($data['address'])
            || isset($data['address2']) || isset($data['inputCity'])
            || isset($data['state'])) {
            $addressArray = Address::where('user_id', $auser->id)->get();
            if (sizeof($addressArray) > 0) {
                $addressArray[0]->update([
                    'address' => $data['address'],
                    'address2' => $data['address2'],
                    'city' => $data['inputCity'],
                    'state' => $data['state'],
                    'postal_code' => $data['inputZip'],
                ]);
                $address = $addressArray[0];
            } else {
                $address = Address::create([
                    'user_id' => $auser->id,
                    'address' => $data['address'],
                    'address2' => $data['address2'],
                    'city' => $data['inputCity'],
                    'state' => $data['state'],
                    'postal_code' => $data['inputZip']
                ]);
            }
        }

        if (array_key_exists('selectedUserType', $data)) {
            $auser->usertype = $data['selectedUserType'];
            $auser->save();

            $distributor = '';
            $distributorArray = Distributor::where('user_id', $auser->id)->get();
            if (empty($distributorArray[0])) {
                $distributor =
                    Distributor::create([
                        'user_id' => $auser->id,
                        'distributor_name' => $data['distributorName'],
                        'shipping_address_id' => $address->id,
                        'physical_address_id' => 0,
                        'credit_limit' => 0,
                        'payment_term' => 'net 30',
                    ]);
            } else {
                $distributor = $distributorArray[0];
                $distributor->update([
                    'distributor_name' => $data['distributorName'],
                    'shipping_address_id' => $address->id,
                ]);
            }
            if (isset($data['contactPerson'])) {
                $distributor->update([
                    'primary_contact' => $data['contactPerson'],
                ]);
            }

            if (isset($data['contactPersonPhone'])) {
                $distributor->update([
                    'primary_phone' => $data['contactPersonPhone'],
                ]);
            }

            if (isset($data['contactPerson2'])) {
                $distributor->update([
                    'secondary_contact' => $data['contactPerson2'],
                ]);
            }

            if (isset($data['contactPersonPhone2'])) {
                $distributor->update([
                    'secondary_phone' => $data['contactPersonPhone2'],
                ]);
            }

            switch ($data['selectedUserType']) {
                case 'distributor':
                    $auser->assignGroup(['distributor-grp']);
                    break;
                case 'sales_manager':
                    $auser->assignGroup(['slsmgr-grp']);
                    if(isset($data['selectedDistributor']))
                        $auser->update(['distributor_id' => $data['selectedDistributor']]);
                    break;
                case 'sales':
                    $auser->assignGroup(['sales-grp']);
                    if(isset($data['selectedDistributor']))
                        $auser->update(['distributor_id' => $data['selectedDistributor']]);
                    break;
                case 'dealer':
                    $auser->assignGroup(['dealer-grp']);
                    if(isset($data['selectedDistributor']))
                        $auser->update(['distributor_id' => $data['selectedDistributor']]);
                    break;

            }
        }

    }

    public function show_bkk($id)
    {
        $user = User::findOrFail($id);
        $user->user_type = UserProvider::getUserType($user);

        $distributors = User::join('distributors', 'distributors.user_id', '=', 'users.id')->where(['usertype' => 'distributor', 'users.disabled' => '0'])->select('distributors.*')->get();
        $manufacturers = User::where('usertype', 'manufacturer')->get();
        if (empty($user->address)) {
            $user->address = new Address();
        }

        if($user->user_type == 'distributor'){
            $distributors = Distributor::where('user_id', $user->id)->get();
            if (empty($distributors[0])) {
                $distributors[0] = new Distributor();
            }
            return view('user.viewone',
                ['usermodel' => $user,
                    'contactinfo' => $distributors[0],
                    'manufacturers' => $manufacturers]);

        }else if($user->user_type == 'direct_dealer'){
            $distributors = DirectDealer::where('user_id', $user->id)->get();
            if (empty($distributors[0])) {
                $distributors[0] = new Distributor();
            }
            return view('user.viewone',
                ['usermodel' => $user,
                    'contactinfo' => $distributors[0],
                    'manufacturers' => $manufacturers]);
        }
        else{
            $distributor = Distributor::where('user_id', $user->id)->get();
            if (empty($distributor[0])) {
                $distributor[0] = new Distributor();
            }
            return view('user.viewone',
                ['usermodel' => $user,
                    'contactinfo' => $distributor[0],
                    'distributors' => $distributors,
                    'manufacturers' => $manufacturers]);
        }
    }



    public function update_bkk()
    {
        $data = request()->all();
        //dd($data);
        if (isset($data['inputZip']) || isset($data['address'])
            || isset($data['address2']) || isset($data['inputCity'])
            || isset($data['state'])) {
            $data = request()->validate([
                'email'                 => 'required',
                'selectedUserType'      => '',
                'name'                  => 'required',
                'existingUserId'        => '',
                'selectedDistributor'   => '',
                'distributorName'       => '',
                'contactPerson'         => 'required',
                'contactPerson2'        => '',
                'contactPersonPhone'    => '',
                'contactPersonPhone2'   => '',
                'address'               => 'required',
                'address2'              => '',
                'inputCity'             => 'required',
                'state'                 => 'required',
                'inputZip'              => 'required',
                'password'              => '',
            ]);
        } else {
            $data = request()->validate([
                'email'                 => 'required',
                'selectedUserType'      => '',
                'name'                  => 'required',
                'existingUserId'        => '',
                'selectedDistributor'   => '',
                'distributorName'       => '',
                'contactPerson'         => 'required',
                'contactPerson2'        => '',
                'contactPersonPhone'    => '',
                'contactPersonPhone2'   => '',
                'address'               => '',
                'address2'              => '',
                'inputCity'             => '',
                'state'                 => '',
                'inputZip'              => '',
                'password'              => '',
            ]);
        }


        //dd($data);
        $this->storeOrCreateUser($data);
        //Moving the updATE PART HERE



        $users = User::orderby('created_at', 'asc')->get();


        Session::flash('success', 'User Created / Updated');
        return redirect()->route('uview');

//        return view('user.view',
//            ['detailedusers' => $users]
//        );
    }
}
