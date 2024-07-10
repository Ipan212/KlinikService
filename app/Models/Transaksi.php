<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_pasien',
        'total_biaya',
        'tanggal_transaksi'
    ];
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }
    public function obat()
    {
        return $this->belongsToMany(Obat::class, 'transaksi_obat', 'id_transaksi', 'id_obat')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
    public function pemeriksaan()
    {
        return $this->belongsToMany(Pemeriksaan::class, 'transaksi_pemeriksaan', 'id_transaksi', 'id_jespem')
                    ->withTimestamps();
    }
}
