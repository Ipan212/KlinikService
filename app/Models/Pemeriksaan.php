<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';
    protected $primaryKey = 'id_jespem';

    protected $fillable = [
        'nama_jespem',
        'biaya'
    ];

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_jespem', 'id_jespem');
    }
}
