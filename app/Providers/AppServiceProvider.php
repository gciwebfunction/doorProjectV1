<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order\Order;
use App\Models\Order\OrderRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;

//use Illuminate\Support\Facades\Session;

use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\View;


#use Illuminate\Http\Request;

use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }





    /**
     * Bootstrap any application services.
     * can pass any of data here and it will be accessible for each of the view elements
     * @return void
     */
    public function boot()
    {
        //$categoriesdeop = Category::all();
        $categoriesdeop = Category::select('id',
            'category_name',
            'category_note',
            'image_id',
            'image',
            'type')->orderBy('type', 'asc')->get();

        // avaialble for all categories
        View::share('categoriesdeop', $categoriesdeop);

        View::composer('*', function ($view){

            $tmp_u_id   =   auth()->user()->id??null;
            $tmp_u_t    =   auth()->user()->usertype??null;
            if($tmp_u_id) {
                View::share('global_user_id', $tmp_u_id);
                View::share('global_user_type', $tmp_u_t);

                // 3 level notificaiton starts
                switch ($tmp_u_t):
                    case "sales":
                        $orderRequests3lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '3 level' and  current_level = '3'
                            ORDER BY id DESC;
                            ");
                        break;
                    case "sales_user":
                        $orderRequests3lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '3 level' and  current_level = '3'
                            ORDER BY id DESC;
                            ");
                        break;
                    case "distributor":
                        $orderRequests3lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '3 level' and  current_level = '4'
                            ORDER BY id DESC;
                            ");
                        break;
                    case "dealer":
                        $orderRequests3lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '3 level' and  current_level = '4'
                            ORDER BY id DESC;
                            ");
                        break;
                    default:// for manufacturer
                        $orderRequests3lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '3 level' and  current_level = '3'
                            ORDER BY id DESC;
                            ");
                endswitch;
                // 3 level notificaiton ends


                // 2 level notificaiton starts
                switch ($tmp_u_t):

                    case "sales":
                        $orderRequests2lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '2 level' and  current_level = '2'
                            ORDER BY id DESC;
                            ");
                        break;
                    case "manufacturer":
                        $orderRequests2lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '2 level' and  current_level = '2'
                            ORDER BY id DESC;
                            ");
                        break;
                    case "distributor":
                        $orderRequests2lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '2 level' and  current_level = '3'
                            ORDER BY id DESC;
                            ");
                        break;

                    default:// for direct_dealer
                        $orderRequests2lvel = DB::select("
                            SELECT count(*)  AS counttii FROM  order_requests
                            WHERE  request_type = '2 level' and  current_level = '3'
                            ORDER BY id DESC;
                            ");
                endswitch;
                // 2 level ends

                View::share('orderRequests2lvel', $orderRequests2lvel);
                View::share('orderRequests3lvel', $orderRequests3lvel);
            }
        });

        ;
        //dd($user->usertype);
        // can't get the session directly here as before session starts this one executes
        // for getting session  // views composer is called above for the notifications


    }

    // no needs
    public function boot_bkk()
    {
        //
    }
}
