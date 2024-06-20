<?php

namespace App\Http\Controllers;

use App\Models\Fisik;
use App\Models\pasien;
use Illuminate\Http\Request;

class FisikController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        return view('fisik.index', compact('pasien'));
    }

    public function data()
    {
        $fisik = Fisik::with('pasien')->orderBy('id_fisik')->get();

        return datatables()
            ->of($fisik)
            ->addIndexColumn()
            ->addColumn('select_all', function ($fisik) {
                return '
                    <input type="checkbox" name="id_fisik[]" value="'. $fisik->id_fisik .'">
                ';
            })
            ->addColumn('pasien', function ($fisik) {
                return $fisik->pasien->nama_pasien;
            })
            ->addColumn('aksi', function ($fisik) {
                return '
                    <button type="button" onclick="editForm(`'. route('fisik.update', $fisik->id_fisik) .'`)" class="btn btn-xs btn-info"><i class="fa fas fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`'. route('fisik.destroy', $fisik->id_fisik) .'`)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                ';
            })
            ->rawColumns(['select_all','aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien'
        ]);
        $fisik = fisik::create([
            'id_pasien' => $request->id_pasien,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'tekanan_darah' =>$request->tekanan_darah,
            'penyakit_bawaan' =>$request->penyakit_bawaan,
        ]);
    
        return response()->json('Data berhasil disimpan', 200);
    }
    
    public function show(string $id)
    {
        $fisik = Fisik::find($id);

        return response()->json($fisik);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
        ]);

        $fisik = Fisik::find($id);
        $fisik->update($request->all());

        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy(string $id)
    {
        $fisik = Fisik::find($id);
        $fisik->delete();

        return response(null, 204);
    }

}
