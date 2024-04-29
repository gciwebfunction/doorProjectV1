<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesCartItemModifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_item_modifiers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_item_id');
            $table->string('option_name');
            $table->string('option_type');
            $table->string('size_code');
            $table->double('option_additional_price');
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
        Schema::dropIfExists('cart_item_modifiers');
    }
}
