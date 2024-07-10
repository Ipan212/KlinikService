<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedisObat extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis_obat';

    protected $fillable = [
        'id_rekam_medis',
        'id_obat',
        'dosis',
        'frekuensi',
        'durasi'
    ];
}
