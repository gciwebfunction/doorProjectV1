<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by_user_id');
            $table->bigInteger('original_order_request_user_id');
            $table->bigInteger('distributor_id')->default(0);
            $table->bigInteger('dealer_id')->default(0);
            $table->bigInteger('requesting_dealer_id')->default(0);
            $table->bigInteger('product_list_id')->default(0);
            $table->string('purchase_order_number')->nullable();
            $table->double('total_order_amount')->default(0);
            $table->string('pay_term', 255)->nullable();
            $table->string('freight_term', 255)->nullable();
            $table->string('transportation_mode', 555)->nullable();
            $table->timestamp('required_shipping_date')->nullable();
            $table->timestamp('scheduled_shipping_date')->nullable();
            $table->string('product_inst', 255)->nullable();
            $table->string('prepared_by', 255)->nullable();
            $table->string('shipping_instruction', 555)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
