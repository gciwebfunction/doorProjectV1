<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Sales Manager
         */
        DB::table('permissions')->insert([
            'id' => 100001,
            'name' => 'create_sales_manager',
            'slug' => 'c_sales_manager',
            'description' => 'Ability to create a sales manager.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100002,
            'name' => 'read_sales_manager',
            'slug' => 'r_sales_manager',
            'description' => 'Ability to read a sales manager.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100003,
            'name' => 'update_sales_manager',
            'slug' => 'u_sales_manager',
            'description' => 'Ability to update a sales manager.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100004,
            'name' => 'delete_sales_manager',
            'slug' => 'd_sales_manager',
            'description' => 'Ability to inactivate sales manager.',
        ]);

        /**
         * Sales User
         */
        DB::table('permissions')->insert([
            'id' => 100005,
            'name' => 'create_sales_user',
            'slug' => 'c_sales_user',
            'description' => 'Ability to create a sales user.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100006,
            'name' => 'read_sales_user',
            'slug' => 'r_sales_user',
            'description' => 'Ability to read a sales user.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100007,
            'name' => 'update_sales_user',
            'slug' => 'u_sales_user',
            'description' => 'Ability to update a sales user.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100008,
            'name' => 'delete_sales_user',
            'slug' => 'd_sales_user',
            'description' => 'Ability to inactivate sales user.',
        ]);

        /**
         * Category
         */
        DB::table('permissions')->insert([
            'id' => 100009,
            'name' => 'create_category',
            'slug' => 'c_category',
            'description' => 'Ability to create a category.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100010,
            'name' => 'read_category',
            'slug' => 'r_category',
            'description' => 'Ability to read a category.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100011,
            'name' => 'update_category',
            'slug' => 'u_category',
            'description' => 'Ability to update a category.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100012,
            'name' => 'delete_category',
            'slug' => 'd_category',
            'description' => 'Ability to inactivate a category.',
        ]);

        /**
         * Products
         */
        DB::table('permissions')->insert([
            'id' => 100013,
            'name' => 'create_product',
            'slug' => 'c_product',
            'description' => 'Ability to create a product.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100014,
            'name' => 'read_product',
            'slug' => 'r_product',
            'description' => 'Ability to read a product.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100015,
            'name' => 'update_product',
            'slug' => 'u_product',
            'description' => 'Ability to update a product.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100016,
            'name' => 'delete_product',
            'slug' => 'd_product',
            'description' => 'Ability to inactivate a product.',
        ]);

        /**
         * Terms
         */
        DB::table('permissions')->insert([
            'id' => 100017,
            'name' => 'create_terms',
            'slug' => 'c_terms',
            'description' => 'Ability to create terms.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100018,
            'name' => 'read_terms',
            'slug' => 'r_terms',
            'description' => 'Ability to read terms.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100019,
            'name' => 'update_terms',
            'slug' => 'u_terms',
            'description' => 'Ability to update terms.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100020,
            'name' => 'delete_terms',
            'slug' => 'd_terms',
            'description' => 'Ability to inactivate terms.',
        ]);

        /**
         * Lead Time
         */
        DB::table('permissions')->insert([
            'id' => 100021,
            'name' => 'create_lead_time',
            'slug' => 'c_lead_time',
            'description' => 'Ability to create a lead time.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100022,
            'name' => 'read_lead_time',
            'slug' => 'r_lead_time',
            'description' => 'Ability to read a lead time.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100023,
            'name' => 'update_lead_time',
            'slug' => 'u_lead_time',
            'description' => 'Ability to update a lead time.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100024,
            'name' => 'delete_lead_time',
            'slug' => 'd_lead_time',
            'description' => 'Ability to inactivate a lead time.',
        ]);

        /**
         * Distributor
         */
        DB::table('permissions')->insert([
            'id' => 100025,
            'name' => 'create_distributor',
            'slug' => 'c_distributor',
            'description' => 'Ability to create a distributor.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100026,
            'name' => 'read_distributor',
            'slug' => 'r_distributor',
            'description' => 'Ability to read a distributor.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100027,
            'name' => 'update_distributor',
            'slug' => 'u_distributor',
            'description' => 'Ability to update a distributor.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100028,
            'name' => 'delete_distributor',
            'slug' => 'd_distributor',
            'description' => 'Ability to inactivate a distributor.',
        ]);

        /**
         * Direct Dealer
         */
        DB::table('permissions')->insert([
            'id' => 100029,
            'name' => 'create_direct_dealer',
            'slug' => 'c_direct_dealer',
            'description' => 'Ability to create a direct dealer.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100030,
            'name' => 'read_direct_dealer',
            'slug' => 'r_direct_dealer',
            'description' => 'Ability to read a direct dealer.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100031,
            'name' => 'update_direct_dealer',
            'slug' => 'u_direct_dealer',
            'description' => 'Ability to update a direct dealer.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100032,
            'name' => 'delete_direct_dealer',
            'slug' => 'd_direct_dealer',
            'description' => 'Ability to inactivate a direct dealer.',
        ]);

        /**
         * Orders
         */
        DB::table('permissions')->insert([
            'id' => 100033,
            'name' => 'create_order',
            'slug' => 'c_order',
            'description' => 'Ability to create an order.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100034,
            'name' => 'read_order',
            'slug' => 'r_order',
            'description' => 'Ability to read an order.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100035,
            'name' => 'update_order',
            'slug' => 'u_order',
            'description' => 'Ability to update an order.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100036,
            'name' => 'delete_order',
            'slug' => 'd_order',
            'description' => 'Ability to inactivate an order (or remove).',
        ]);
        DB::table('permissions')->insert([
            'id' => 100037,
            'name' => 'confirm_order',
            'slug' => 'cf_order',
            'description' => 'Ability to confirm an order.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100038,
            'name' => 'convert_order',
            'slug' => 'cv_order',
            'description' => 'Ability to convert an order.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100039,
            'name' => 'read_order_status',
            'slug' => 'r_order_status',
            'description' => 'Ability to check the status of an order.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100040,
            'name' => 'update_order_status',
            'slug' => 'u_order_status',
            'description' => 'Ability to update order status.',
        ]);

        DB::table('permissions')->insert([
            'id' => 100041,
            'name' => 'update_user',
            'slug' => 'u_user',
            'description' => 'Ability to update users.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100042,
            'name' => 'create_user',
            'slug' => 'c_user',
            'description' => 'Ability to create users.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100043,
            'name' => 'read_user',
            'slug' => 'r_user',
            'description' => 'Ability to view users.',
        ]);
        DB::table('permissions')->insert([
            'id' => 100044,
            'name' => 'delete_user',
            'slug' => 'd_user',
            'description' => 'Ability to make user accounts inactive.',
        ]);

        DB::table('permissions')->insert([
            'id' => 100045,
            'name' => 'read_order_request',
            'slug' => 'r_order_request',
            'description' => 'Ability to make read an order request.',
        ]);

        DB::table('permissions')->insert([
            'id' => 100046,
            'name' => 'create_order_request',
            'slug' => 'c_order_request',
            'description' => 'Ability to create an order request.',
        ]);

        DB::table('permissions')->insert([
            'id' => 100047,
            'name' => 'update_order_request',
            'slug' => 'u_order_request',
            'description' => 'Ability to update order requests.',
        ]);

        DB::table('permissions')->insert([
            'id' => 100048,
            'name' => 'delete_order_request',
            'slug' => 'd_order_request',
            'description' => 'Ability to make order requests inactive.',
        ]);
    }
}
