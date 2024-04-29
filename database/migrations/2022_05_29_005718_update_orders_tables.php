<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_requests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('order_requests', function (Blueprint $table) {
            $table->integer('status')->default(-1);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('status')->default(-1);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('associated_manufacturer');
        });
    }
}
