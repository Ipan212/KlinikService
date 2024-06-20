<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\Obat;

class RekamMedisController extends Controller
{
    public function create()
    {
        $pasiens = Pasien::all();
        $jenis_pemeriksaans = Pemeriksaan::all();
        $obats = Obat::all();

        return view('rekam_medis.create', compact('pasiens', 'jenis_pemeriksaans', 'obats'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'diagnosa' => 'nullable|string',
            'id_jespem' => 'nullable|exists:pemeriksaan,id_jespem',
            'instruksi_khusus' => 'nullable|string',
            'rujukan' => 'nullable|string',
            'id_obat' => 'nullable|array',
            'id_obat.*' => 'exists:obat,id_obat',
            'dosis' => 'nullable|array',
            'frekuensi' => 'nullable|array',
            'durasi' => 'nullable|array',
        ]);

        $rekamMedis = RekamMedis::create($validatedData);

        if ($request->has('id_obat')) {
            foreach ($request->id_obat as $index => $id_obat) {
                $rekamMedis->obats()->attach($id_obat, [
                    'dosis' => $request->dosis[$index],
                    'frekuensi' => $request->frekuensi[$index],
                    'durasi' => $request->durasi[$index],
                ]);
            }
        }

        return redirect()->route('rekam_medis.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(RekamMedis $rekam_medi)
    {
        $pasiens = Pasien::all();
        $jenis_pemeriksaans = Pemeriksaan::all();
        $obats = Obat::all();
    
        return view('rekam_medis.edit', compact('rekam_medi', 'pasiens', 'jenis_pemeriksaans', 'obats'));
    }
    
    public function update(Request $request, RekamMedis $rekam_medi)
    {
        $validatedData = $request->validate([
            'diagnosa' => 'nullable|string',
            'id_jespem' => 'nullable|exists:pemeriksaan,id_jespem',
            'instruksi_khusus' => 'nullable|string',
            'rujukan' => 'nullable|string',
            'id_obat' => 'nullable|array',
            'id_obat.*' => 'exists:obat,id_obat',
            'dosis' => 'nullable|array',
            'frekuensi' => 'nullable|array',
            'durasi' => 'nullable|array',
        ]);
    
        $rekam_medi->update($validatedData);
    
        if ($request->has('id_obat')) {
            $rekam_medi->obats()->sync([]);
    
            foreach ($request->id_obat as $index => $id_obat) {
                $rekam_medi->obats()->attach($id_obat, [
                    'dosis' => $request->dosis[$index],
                    'frekuensi' => $request->frekuensi[$index],
                    'durasi' => $request->durasi[$index],
                ]);
            }
        }
    
        return redirect()->route('rekam_medis.index')->with('success', 'Data berhasil diperbarui');
    }
    

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $rekamMedis = RekamMedis::with(['pasien', 'jenisPemeriksaan', 'obats'])
            ->whereHas('pasien', function($query) use ($search) {
                $query->where('nama_pasien', 'like', "%{$search}%")
                      ->orWhere('kode_pasien', 'like', "%{$search}%");
            })
            ->get();
    
        return view('rekam_medis.index', compact('rekamMedis'));
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pasien', 'jenisPemeriksaan', 'obats'])->findOrFail($id);
        return view('rekam_medis.show', compact('rekamMedis'));
    }

    public function destroy(RekamMedis $rekam_medi)
    {
        $rekam_medi->delete();
        return redirect()->route('rekam_medis.index')->with('success', 'Data berhasil dihapus');
    }
}
