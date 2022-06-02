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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_field_id');
            $table->string('type', 50)->default('text');
            $table->uuid('uuid')->nullable();
            $table->string('placeholder', 255)->nullable();

            $table->timestamps();

            $table->foreign('group_field_id')
                ->references('id')
                ->on('group_fields')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
};
