<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id('id_obat');
            $table->string('kode_obat');
            $table->string('nama_obat');
            $table->string('kegunaan');
            $table->integer('harga');
            $table->integer('stok');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
