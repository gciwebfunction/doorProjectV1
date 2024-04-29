<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('panelcount');
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('lightcount');
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('option_name')->default('');
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('product_size')->default('');
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('product_color')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->integer('panelcount')->default(1);
        });
        Schema::table('cart_items', function (Blueprint $table) {
            $table->integer('lightcount')->default(1);
        });
    }
}
