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
            $table->timestamp('date_birth');
            $table->string('place_birth');
            $table->enum('blood_group', ["A", "B", "O", "AB"])->default(null);
            $table->string('no_paspor')->default(null);
            $table->string('nik')->default(null);
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
