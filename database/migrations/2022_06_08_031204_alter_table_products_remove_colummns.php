<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProductsRemoveColummns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('light_count');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('panel_count');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('glass_material');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('glass_thick');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('handle_type');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('lock_set_type');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('lock_set_color');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('predrill_type');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('wall_thick');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('glass_material');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('glass_thick');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('handle_type');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('lock_set_type');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('lock_set_color');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('predrill_type');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('wall_thick');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('unit');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('panel_count');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('light_count');
        });
    }
}
