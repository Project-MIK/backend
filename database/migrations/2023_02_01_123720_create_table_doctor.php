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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->enum('gender', ['W', 'M']);
            $table->string('address')->nullable(false);
            $table->integer('phone');
            $table->unsignedBigInteger('id_polyclinic');
            $table->foreign('id_polyclinic')->references('id')->on('polyclinics')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('doctors');
    }
};
