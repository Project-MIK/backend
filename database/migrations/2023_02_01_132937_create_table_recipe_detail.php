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
        Schema::create('recipe_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_recipe')->nullable(false);
            $table->unsignedBigInteger('id_medicine')->nullable(false);
            $table->foreign('id_recipe')->references('id')->on('recipes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_medicine')->references('id')->on('medicines')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('recipe_detail');
    }
};
