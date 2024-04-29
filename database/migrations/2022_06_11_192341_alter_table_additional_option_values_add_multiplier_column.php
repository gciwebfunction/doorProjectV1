<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAdditionalOptionValuesAddMultiplierColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_option_values', function (Blueprint $table) {
            $table->integer('multiplier')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_option_values', function (Blueprint $table) {
            $table->dropColumn('multiplier');
        });
    }
}
