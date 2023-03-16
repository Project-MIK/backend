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
            $table->integer("price_medical_prescription")->default(0);
            $table->enum('pickup_medical_prescription' , ['hospital-pharmacy' , 'delivery-gojek'])->default('hospital-pharmacy');
            $table->enum('pickup_medical_status' , ['MENUNGGU DIAMBIL' , 'SUDAH DIAMBIL'  , 'DIKIRIM DENGAN GOJEK' , 'GAGAL DIKIRIM'])->default('MENUNGGU DIAMBIL');
            $table->string('pickup_medical_addreass_pacient')->nullable(true);
            $table->enum('status_payment_medical_prescription' , ['PROSES VERIFIKASI' , 'BELUM TERKONFIRMASI' , 'TERKONFIRMASI' , 
            'DIBATALKAN'])->default('BELUM TERKONFIRMASI');
            $table->string('no_telp_delivery')->nullable(true);
            $table->string('proof_payment_medical_prescription')->nullable(true);
            $table->enum('pickup_medical_description' , ['alamat penerima tidak valid' , 'pasien tidak dapat dihubungi'])->nullable(true);
            $table->timestamp('pickup_datetime')->nullable(true);
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
