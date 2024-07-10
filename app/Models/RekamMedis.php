<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RekamMedis extends Model
{
    use HasFactory;
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekam_medis';
    protected $fillable = [
        'id_pasien',
        'diagnosa',
        'id_jespem',
        'instruksi_khusus',
        'rujukan'
    ];
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function jenisPemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'id_jespem', 'id_jespem');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'rekam_medis_obat', 'id_rekam_medis', 'id_obat')
                    ->withPivot('dosis', 'frekuensi', 'durasi')
                    ->withTimestamps();
    }
}
