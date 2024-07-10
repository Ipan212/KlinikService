<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id('id_rekam_medis');
            $table->unsignedBigInteger('id_pasien');
            $table->text('diagnosa')->nullable();
            $table->unsignedBigInteger('id_jespem')->nullable();
            $table->text('instruksi_khusus')->nullable();
            $table->text('rujukan')->nullable();
            $table->timestamps();

            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('cascade');
            $table->foreign('id_jespem')->references('id_jespem')->on('pemeriksaan')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
