<?php

// app/Models/Pasien.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'nama_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telp'
    ];

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_pasien', 'id_pasien');
    }
}
