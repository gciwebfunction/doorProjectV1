<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('distributor_name', 600);
            $table->foreign('primary_contact_id')->references('id')->on('contact_people')->onDelete('cascade');
            $table->foreign('secondary_contact_id')->references('id')->on('contact_people')->onDelete('cascade');
            $table->foreign('primary_phone_id')->references('id')->on('phone_number')->onDelete('cascade');
            $table->foreign('secondary_phone_id')->references('id')->on('phone_number')->onDelete('cascade');
            $table->foreign('primary_fax_id')->references('id')->on('phone_number')->onDelete('cascade');
            $table->foreign('secondary_fax_id')->references('id')->on('phone_number')->onDelete('cascade');
            $table->foreign('physical_address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('shipping_address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->string('credit_limit', 600);
            $table->string('payment_term', 600);
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
        Schema::dropIfExists('distributors');
    }
}
