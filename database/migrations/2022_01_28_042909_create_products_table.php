<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 255);
            $table->string('prod_type', 255)->nullable();
            $table->integer('height')->nullable();
            $table->string('width')->nullable();
            $table->string('color')->nullable();
            $table->string('glass_type')->nullable();
            $table->string('glass_material')->nullable();
            $table->string('glass_thick')->nullable();
            $table->string('handle_type')->nullable();
            $table->string('lock_set_type')->nullable();
            $table->string('lock_set_color')->nullable();
            $table->string('predrill_type')->nullable();
            $table->string('wall_thick')->nullable();
            $table->string('unit')->nullable();
            $table->double('unit_price')->nullable();
            $table->string('part_number')->nullable();
            $table->bigInteger('image_id')->nullable();
            $table->string('prod_description')->nullable();
            $table->integer('panel_count')->default(0);
            $table->integer('light_count')->default(0);
            $table->bigInteger('category_id');
            $table->string('object_type')->default('product');
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
        Schema::dropIfExists('products');
    }
}
