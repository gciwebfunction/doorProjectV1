<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDoorItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('door_items', function (Blueprint $table) {
            $table->string('discount_type')->default('');
        });

        Schema::table('door_items', function (Blueprint $table) {
            $table->integer('discount_amount')->nullable();
        });
        Schema::table('door_items', function (Blueprint $table) {
            $table->float('calculated_discount' , 11,2)->nullable();
        });
        Schema::table('door_items', function (Blueprint $table) {
            $table->string('sub_total' , 11,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('door_items', function (Blueprint $table) {
            //
        });
    }
}
