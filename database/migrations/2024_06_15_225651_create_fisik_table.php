<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fisik', function (Blueprint $table) {
            $table->id('id_fisik');
            $table->unsignedBigInteger('id_pasien');
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('tekanan_darah');
            $table->string('penyakit_bawaan');
            $table->timestamps();

            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fisik');
    }
};
