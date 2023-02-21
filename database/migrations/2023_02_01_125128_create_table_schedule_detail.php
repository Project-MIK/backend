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

        Schema::dropIfExists("schedule_detail");

        Schema::create('schedule_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_schedule');
            $table->timestamp('consultation_date');
            $table->timestamp('time_start')->nullable();
            $table->timestamp('time_end')->nullable();
            $table->string('link');
            $table->enum('status', ['selesai' , 'belum_selesai' , 'tidak_aktif']);
            $table->foreign('id_schedule')->references('id')->on('schedules')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('schedule_detail');
    }
};
