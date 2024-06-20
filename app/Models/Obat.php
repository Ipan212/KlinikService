<?php

// app/Models/Obat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'kegunaan',
        'harga',
        'stok'
    ];

    public function rekamMedis()
    {
        return $this->belongsToMany(RekamMedis::class, 'rekam_medis_obat', 'id_obat', 'id_rekam_medis')
                    ->withPivot('dosis', 'frekuensi', 'durasi')
                    ->withTimestamps();
    }
}
