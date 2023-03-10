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
        Schema::create('recovery_pattient', function (Blueprint $table) {
            $table->string('token')->primary();
            $table->timestamp('expired')->nullable(false);
            $table->unsignedBigInteger('id_pattient');
            $table->foreign('id_pattient')->references('id')
            ->on('pattient')
            ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('recovery_pattient');
    }
};
