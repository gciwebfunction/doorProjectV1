<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesFinishOptionProductSizeCodePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish_option_product_size_code', function (Blueprint $table) {
            $table->bigInteger('finish_option_id');
            $table->bigInteger('product_size_code_id');
            $table->bigInteger('product_id');
            $table->double('finish_option_price');
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
        Schema::dropIfExists('finish_option_product_size_code');
    }
}
