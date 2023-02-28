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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable(true);
            $table->integer("total_price");
            $table->enum('pickup_medical_prescription' , ['hospital-pharmacy' , 'delivery-gojek']);
            $table->enum('pickup_medical_status' , ['MENUNGGU DIAMBIL' , 'SUDAH DIAMBIL'  , 'DIKIRIM DENGAN GOJEK' , 'GAGAL DIKIRIM']);
            $table->string('pickup_medical_addreass_pacient')->nullable(false);
            $table->enum('pickup_medical_description' , ['alamat penerima tidak valid' , 'pasien tidak dapat dihubungi']);
            $table->timestamp('pickup_datetime');
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
        Schema::dropIfExists('recipes');
    }
};
