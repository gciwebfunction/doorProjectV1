<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesAddOnOptionProductSizeCodePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_on_option_product_size_code', function (Blueprint $table) {
            $table->bigInteger('add_on_option_id');
            $table->bigInteger('product_size_code_id');
            $table->bigInteger('product_id');
            $table->double('add_on_option_price');
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
        Schema::dropIfExists('add_on_option_product_size_code');
    }
}
