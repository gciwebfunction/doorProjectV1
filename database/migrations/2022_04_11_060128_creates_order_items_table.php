<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->string('item')->nullable();
            $table->string('prod_type')->nullable();
            $table->string('prod')->nullable();
            $table->string('spec')->nullable();
            $table->string('width');
            $table->string('height');
            $table->string('panel_type')->nullable();
            $table->string('door_type')->nullable();
            $table->string('door_frame')->nullable();
            $table->string('color_code')->nullable();
            $table->string('glass_type')->nullable();
            $table->string('glass_material')->nullable();
            $table->string('glass_thickness')->nullable();
            $table->string('handle')->nullable();
            $table->string('lock_set_type')->nullable();
            $table->string('lock_set_color')->nullable();
            $table->string('predrill_type')->nullable();
            $table->string('wall_thickness')->nullable();
            $table->string('order')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('unit')->default(1);
            $table->double('unit_price')->default(0);
            $table->double('amount')->default(0);
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
        Schema::dropIfExists('order_items');
    }
}
