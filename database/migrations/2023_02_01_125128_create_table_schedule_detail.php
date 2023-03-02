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
            $table->date('consultation_date');
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->string('link');
            $table->enum('status', ['kosong' , 'terisi']);
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->cascadeOnUpdate()->nullOnDelete();
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
