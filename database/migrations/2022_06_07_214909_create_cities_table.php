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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->unsignedBigInteger('state_id')->nullable(false);
            $table->string('tse_id', 32);
            $table->string('mayor_name', 100);
            $table->integer('habitant_qty');
            $table->integer('electures_qty');
            $table->timestamps();

            $table->foreign('state_id')
                ->references('id')
                ->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
