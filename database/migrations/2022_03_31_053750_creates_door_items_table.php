<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesDoorItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('order_id')->default(-1);
            $table->bigInteger('shopping_cart_id');
            $table->bigInteger('order_request_id')->default(-1);
            $table->bigInteger('door_id');
            $table->string('door_name');
            $table->string('category_name');
            $table->string('door_type_pretty_name');
            $table->integer('quantity');
            $table->double('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('door_items');
    }
}
