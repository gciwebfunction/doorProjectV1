<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManufacturerShippingDateToOrderRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_requests', function (Blueprint $table) {
            //$table->timestamp('manufacturer_shipping_dates')->default('')->useCurrent();
            $table->timestamp('manufacturer_shipping_date')->nullable()->useCurrent();
            //$table->timestamp('manufacturer_shipping_dates')->useCurrent();
        });

        Schema::table('order_requests', function (Blueprint $table) {
            $table->string('req_generator_type')->default('');
        });
        Schema::table('order_requests', function (Blueprint $table) {
            $table->string('request_type')->default('');
        });
        Schema::table('order_requests', function (Blueprint $table) {
            $table->string('current_level')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_requests', function (Blueprint $table) {
            //
        });
    }
}
