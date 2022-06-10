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
        Schema::create('city_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('candidate_id');
            $table->decimal('votes_pp', 8, 2, true)->nullable(true);
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->delete('onCascade');
            $table->foreign('candidate_id')->references('id')->on('candidates')->delete('onCascade');
            $table->index('votes_pp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_candidates');
    }
};
