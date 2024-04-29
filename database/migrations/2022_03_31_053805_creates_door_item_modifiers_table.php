<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesDoorItemModifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('door_item_modifiers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('door_item_id');
            $table->string('door_modifier_key');
            $table->string('door_modifier_value');
            $table->boolean('is_base_price');
            $table->double('price_multiplier');
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
        Schema::dropIfExists('door_item_modifiers');
    }
}
