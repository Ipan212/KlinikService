<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klinik;

class KlinikController extends Controller
{
    public function index()
    {
        return view('klinik.index');
    }

    public function data()
    {
        $klinik = Klinik::orderBy('id_klinik')->get();

        return datatables()
            ->of($klinik)
            ->addIndexColumn()
            ->addColumn('aksi', function ($klinik) {
                return '
                    <button type="button" onclick="editForm(`'. route('klinik.update', $klinik->id_klinik) .'`)" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`'. route('klinik.destroy', $klinik->id_klinik) .'`)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $klinik = Klinik::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function show($id)
    {
        $klinik = Klinik::find($id);

        return response()->json($klinik);
    }

    public function update(Request $request, $id)
    {
        $klinik = Klinik::find($id);
        $klinik->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy($id)
    {
        $klinik = Klinik::find($id);
        $klinik->delete();

        return response(null, 204);
    }
}
