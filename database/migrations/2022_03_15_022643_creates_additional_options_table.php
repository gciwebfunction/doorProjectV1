<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesAdditionalOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_options', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('group_name');
            $table->double('price')->default(-1);
            $table->boolean('is_per_panel')->default(false);
            $table->boolean('is_per_light')->default(false);
            $table->bigInteger('door_id');
            $table->bigInteger('door_measurement_id');
            $table->bigInteger('image_id')->default(-1);
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
        Schema::dropIfExists('additional_options');
    }
}
