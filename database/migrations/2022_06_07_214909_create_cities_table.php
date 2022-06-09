<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
            $table->string('name', 100);
            $table->unsignedBigInteger('state_id');
            $table->string('slug', 50)->unique();
            $table->string('ibge_cod', 32)->unique();
            $table->string('mayor_name', 100)->nullable(true);
            $table->integer('habitant_qty')->nullable(true);
            $table->integer('electures_qty')->nullable(true);
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
