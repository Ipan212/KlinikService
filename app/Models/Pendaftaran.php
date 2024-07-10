<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'id_pasien', 'id_klinik', 'nomor_antrian', 'status'
    ];

    // Constructor untuk mengatur nilai default 'status'
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setAttribute('status', 'menunggu');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function klinik()
    {
        return $this->belongsTo(Klinik::class, 'id_klinik');
    }
}
