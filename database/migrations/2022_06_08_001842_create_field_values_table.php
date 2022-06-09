<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id')->nullable(false);
            $table->unsignedBigInteger('city_id')->nullable(false);
            $table->string('value', 255)->nullable(false);
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields')->delete('onCascade');
            $table->foreign('city_id')->references('id')->on('cities')->delete('onCascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_values');
    }
};
