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
        Schema::create('record', function (Blueprint $table) {
            $table->id();
            $table->string('medical_record_id', 6)->nullable(false);
            $table->string('description');
            $table->string('complaint');
            $table->unsignedBigInteger('schedule_detail_id');
            $table->unsignedBigInteger('id_recipe')->nullable(true);
            $table->foreign('schedule_detail_id')->references('id')->on('schedule_details')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('medical_record_id')->references('medical_record_id')->on('medical_records')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_recipe')->references('id')->on('recipes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('record');
    }
};
