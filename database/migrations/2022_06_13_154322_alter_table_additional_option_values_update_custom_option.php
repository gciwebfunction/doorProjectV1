<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAdditionalOptionValuesUpdateCustomOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_option_values', function (Blueprint $table) {
            $table->dropColumn('is_custom_option');
        });
        Schema::table('additional_option_values', function (Blueprint $table) {
            $table->bigInteger('is_custom_option')->default(-1);
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
            $table->dropColumn('is_custom_option');
        });
        Schema::table('additional_option_values', function (Blueprint $table) {
            $table->boolean('is_custom_option')->default(false);
        });
    }
}
