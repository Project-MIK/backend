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
        Schema::create('pattient', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('gender', ["W", "M"]);
            $table->string("phone_number", 13);
            $table->string('address');
            $table->string('password')->nullable(false);
            $table->string('citizen');
            $table->string('profession');
            $table->string('date_birth');
            $table->string('place_birth');
            $table->string('medical_record_id')->nullable();
            $table->enum('blood_group', ["A", "B", "O", "AB"])->nullable(true);
            $table->string('no_paspor', 16)->nullable(true);
            $table->foreign('medical_record_id')->references('medical_record_id')->on('medical_records')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nik', 16)->nullable(true);
            $table->enum('status', [1, 0])->default(0);
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
        Schema::dropIfExists('pattient');
    }
};
