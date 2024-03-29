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
            $table->string('id')->primary();
            $table->string('medical_record_id', 6)->nullable(false);
            $table->string('description');
            $table->string('complaint');
            // $table->foreignId('schedule_id')->nullable()->constrained('schedules')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('schedule_id')->nullable(true);
            $table->unsignedBigInteger('id_recipe')->nullable(true);
            $table->foreign('schedule_id')->references('id')->on('schedule_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('doctor_id');
            $table->string('payment_method')->nullable(true);
            $table->foreign('payment_method')->references('id')->on('payment_metode')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('id_category')->nullable(true);
            $table->enum('status_consultation', ['waiting-consultation-payment', 'confirmed-consultation-payment', 'consultation-complete', 'waiting-medical-prescription-payment', 'confirmed-medical-prescription-payment'])->default('waiting-consultation-payment')->nullable(false);
            $table->string('bukti')->nullable(true);
            $table->foreign('id_category')->references('id')->on('record_category')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->enum('status_payment_consultation', ['DIBATALKAN', 'PROSES VERIFIKASI', 'BELUM TERKONFIRMASI', 'PEMBAYARAN TIDAK VALID', 'TERKONFIRMASI'])->default('BELUM TERKONFIRMASI');
            $table->enum('status_medical_prescription', ['DIBATALKAN', 'PROSES VERIFIKASI', 'BELUM TERKONFIRMASI', 'PEMBAYARAN TIDAK VALID', 'TERKONFIRMASI'])->default('BELUM TERKONFIRMASI');

            $table->timestamp('valid_status')->nullable(true);
            $table->foreign('medical_record_id')->references('medical_record_id')->on('medical_records')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_recipe')->references('id')->on('recipes')->onUpdate('cascade')->onDelete('cascade');
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
