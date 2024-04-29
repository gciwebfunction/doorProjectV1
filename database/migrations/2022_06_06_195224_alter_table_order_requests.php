<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableOrderRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_requests', function (Blueprint $table) {
            $table->bigInteger('ship_to')->default(false);
        });

        Schema::table('order_requests', function (Blueprint $table) {
            $table->bigInteger('ship_from')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_requests', function (Blueprint $table) {
            $table->bigInteger('ship_from');
        });
        Schema::table('order_requests', function (Blueprint $table) {
            $table->bigInteger('ship_to');
        });
    }
}
