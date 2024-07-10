<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pasien;
use Barryvdh\DomPDF\Facade\Pdf;


class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pasien.index');
    }
    
    public function data()
    {
        $pasien = Pasien::orderBy('id_pasien')->get();
    
        return datatables()
            ->of($pasien)
            ->addIndexColumn()
            ->addColumn('select_all', function ($pasien) {
                return '
                    <input type="checkbox" name="id_pasien[]" value="'. $pasien->id_pasien .'">
                ';
            })
            ->addColumn('aksi', function ($pasien) {
                return '
                    <button type="button" onclick="editForm(`'. route('pasien.update', $pasien->id_pasien) .'`)" class="btn btn-xs btn-info "><i class="fa fas fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`'. route('pasien.destroy', $pasien->id_pasien) .'`)" class="btn btn-xs btn-danger "><i class="fa fa-trash"></i></button>
                    <a href="'. route('pasien.showRekamMedis', $pasien->id_pasien) .'" class="btn btn-xs btn-info"><i class="fa fas fa-eye"></i></a>
                ';
            })
            ->rawColumns(['aksi', 'select_all', 'id_pasien'])
            ->make(true);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }
    public function showRekamMedis($id)
    {
    $pasien = Pasien::findOrFail($id);
    $rekamMedis = $pasien->rekamMedis()->with('obats', 'jenisPemeriksaan')->get();
    $pemeriksaanFisik = $pasien->fisik()->get();

    return view('pasien.show', compact('pasien', 'rekamMedis', 'pemeriksaanFisik'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pasien = pasien::latest()->first() ?? new pasien();
        $kode_pasien = (int) $pasien->kode_pasien +1;

        $pasien = new pasien();
        $pasien->kode_pasien = tambah_nol_didepan($kode_pasien, 3);
        $pasien->nama_pasien = $request->nama_pasien;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->tanggal_lahir = $request->tanggal_lahir;
        $pasien->alamat = $request->alamat;
        $pasien->no_telp = $request->no_telp;
        $pasien->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasien = pasien::find($id);

        return response()->json($pasien);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pasien = pasien::find($id);
        $pasien->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = pasien::find($id);
        $pasien->delete();

        return response(null, 204);
    }

    public function cetakPasien(Request $request)
    {
        $datapasien = collect(array());
        foreach ($request->id_pasien as $id) {
            $pasien = pasien::find($id);
            $datapasien[] = $pasien;
        }

        $datapasien = $datapasien->chunk(2);


        $no  = 1;
        $pdf = PDF::loadView('pasien.cetak', compact('datapasien', 'no'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('pasien.pdf');
    }
}

