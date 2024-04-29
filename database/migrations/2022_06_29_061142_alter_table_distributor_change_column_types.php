<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDistributorChangeColumnTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributors', function (Blueprint $table) {
            $table->dropColumn('primary_contact_id');
            $table->dropColumn('secondary_contact_id');
            $table->dropColumn('primary_phone_id');
            $table->dropColumn('secondary_phone_id');
            $table->dropColumn('primary_fax_id');
            $table->dropColumn('secondary_fax_id');
        });

        Schema::table('distributors', function (Blueprint $table) {
            $table->string('primary_contact')->default('');
            $table->string('secondary_contact')->default('');
            $table->string('primary_phone')->default('');
            $table->string('secondary_phone')->default('');
            $table->string('primary_fax')->default('');
            $table->string('secondary_fax')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributors', function (Blueprint $table) {
            $table->dropColumn('primary_contact');
            $table->dropColumn('secondary_contact');
            $table->dropColumn('primary_phone');
            $table->dropColumn('secondary_phone');
            $table->dropColumn('primary_fax');
            $table->dropColumn('secondary_fax');
        });

        Schema::table('distributors', function (Blueprint $table) {
            $table->bigInteger('primary_contact_id');
            $table->bigInteger('secondary_contact_id');
            $table->bigInteger('primary_phone_id');
            $table->bigInteger('secondary_phone_id');
            $table->bigInteger('primary_fax_id');
            $table->bigInteger('secondary_fax_id');
        });

    }
}
