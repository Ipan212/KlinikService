<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pemeriksaan';

    protected $fillable = [
        'id_transaksi',
        'id_jespem'
    ];
}
