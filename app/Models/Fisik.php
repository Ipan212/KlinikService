<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisik extends Model
{
    use HasFactory;

    protected $table = 'fisik';
    protected $primaryKey = 'id_fisik';
    protected $fillable = [
        'id_pasien',
        'tinggi_badan',
        'berat_badan',
        'tekanan_darah',
        'penyakit_bawaan',
    ];

    public function pasien()
    {
        return $this->belongsTo(pasien::class, 'id_pasien', 'id_pasien');
    }
}
