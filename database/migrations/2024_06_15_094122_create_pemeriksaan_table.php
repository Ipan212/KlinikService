<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id('id_jespem');
            $table->string('nama_jespem');
            $table->integer('biaya');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
