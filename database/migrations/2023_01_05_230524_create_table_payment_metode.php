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
        Schema::create('payment_metode', function (Blueprint $table) {
            $table->string('id')->primary()->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('no_rek')->nullable(false);
            $table->string('atas_nama')->nullable(false);
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
        Schema::dropIfExists('payment_metode');
    }
};
