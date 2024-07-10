<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RekamMedis;

class PasienMedisController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('pasien_medis.index', compact('pasien'));
    }

    public function rekamMedis($id)
    {
        $rekamMedis = RekamMedis::with(['jenisPemeriksaan', 'obats'])->where('id_pasien', $id)->get();
        return response()->json($rekamMedis);
    }
}
