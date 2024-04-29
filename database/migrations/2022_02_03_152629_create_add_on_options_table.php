<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddOnOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_on_options', function (Blueprint $table) {
            $table->id();
            $table->string('add_on_option', 255);
            $table->string('add_on_option_description', 600)->nullable();
            $table->double('add_on_option_price')->default(0);
            $table->boolean('is_price_same_for_all_sizes')->default(0);
            $table->boolean('is_per_light')->default(0);
            $table->boolean('is_per_panel')->default(0);
            $table->bigInteger('product_size_code_id')->nullable();
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
        Schema::dropIfExists('add_on_options');
    }
}
