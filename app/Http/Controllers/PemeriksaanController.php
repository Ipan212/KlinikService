<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function index()
    {
        return view('pemeriksaan.index');
    }

    public function data()
    {
        $pemeriksaan = Pemeriksaan::orderBy('id_jespem')->get();

        return datatables()
            ->of($pemeriksaan)
            ->addIndexColumn()
            ->addColumn('biaya', function ($pemeriksaan) {
                return number_format($pemeriksaan->biaya, 0, ',', '.');
            })
            ->addColumn('aksi', function ($pemeriksaan) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('pemeriksaan.update', $pemeriksaan->id_jespem) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`'. route('pemeriksaan.destroy', $pemeriksaan->id_jespem) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jespem' => 'required',
            'biaya' => 'required|numeric',
        ]);

        Pemeriksaan::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function show($id)
    {
        $pemeriksaan = Pemeriksaan::find($id);

        return response()->json($pemeriksaan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jespem' => 'required',
            'biaya' => 'required|numeric',
        ]);

        $pemeriksaan = Pemeriksaan::find($id);
        $pemeriksaan->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::find($id);
        $pemeriksaan->delete();

        return response(null, 204);
    }
}
