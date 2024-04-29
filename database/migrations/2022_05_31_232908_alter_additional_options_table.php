<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAdditionalOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_options', function (Blueprint $table) {
            $table->boolean('is_custom_option')->default(false);
        });
        Schema::table('additional_options', function (Blueprint $table) {
            $table->boolean('has_price')->default(false);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_options', function (Blueprint $table) {
            $table->dropColumn('is_custom_option');
        });
        Schema::table('additional_options', function (Blueprint $table) {
            $table->dropColumn('has_price');
        });
    }
}
