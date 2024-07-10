<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Klinik;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    public function index()
    {
        $klinik = Klinik::all();
        $pasien = Pasien::all();
        return view('pendaftaran.index', compact('klinik', 'pasien'));
    }

    public function data()
    {
        $pendaftaran = Pendaftaran::with('pasien', 'klinik')->orderBy('id_pendaftaran')->get();

        return datatables()
            ->of($pendaftaran)
            ->addIndexColumn()
            ->addColumn('select_all', function ($pendaftaran) {
                return '
                    <input type="checkbox" name="id_pendaftaran[]" value="'. $pendaftaran->id_pendaftaran .'">
                ';
            })
            ->addColumn('kode_pasien', function ($pendaftaran) {
                return $pendaftaran->pasien->kode_pasien;
            })
            ->addColumn('nama_pasien', function ($pendaftaran) {
                return $pendaftaran->pasien->nama_pasien;
            })
            ->addColumn('klinik', function ($pendaftaran) {
                return $pendaftaran->klinik->nama_klinik;
            })
            ->addColumn('nomor_antrian', function ($pendaftaran) {
                return $pendaftaran->nomor_antrian;
            })
            ->addColumn('aksi', function ($pendaftaran) {
                return '
                    <button type="button" onclick="editForm(`'. route('pendaftaran.update', $pendaftaran->id_pendaftaran) .'`)" class="btn btn-xs btn-info"><i class="fa fas fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`'. route('pendaftaran.destroy', $pendaftaran->id_pendaftaran) .'`)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                ';
            })
            ->rawColumns(['select_all', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_klinik' => 'required|exists:klinik,id_klinik',
        ]);

        $nomor_antrian = Pendaftaran::where('id_klinik', $request->id_klinik)->max('nomor_antrian') + 1;

        $pendaftaran = Pendaftaran::create([
            'id_pasien' => $request->id_pasien,
            'id_klinik' => $request->id_klinik,
            'nomor_antrian' => $nomor_antrian,
        ]);

        return response()->json(['message' => 'Data berhasil disimpan', 'nomor_antrian' => $pendaftaran->nomor_antrian], 200);
    }

    public function show(string $id)
    {
        $pendaftaran = Pendaftaran::find($id);

        return response()->json($pendaftaran);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_klinik' => 'required|exists:klinik,id_klinik',
        ]);

        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->update($request->all());

        return response()->json('Data berhasil diupdate', 200);
    }

    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->delete();

        return response(null, 204);
    }

    public function cetakPendaftaran(Request $request)
    {
        $datapendaftaran = collect();
        foreach ($request->id_pendaftaran as $id) {
            $pendaftaran = Pendaftaran::with('pasien', 'klinik')->find($id);
            $datapendaftaran->push($pendaftaran);
        }

        $datapendaftaran = $datapendaftaran->chunk(2);
        $no = 1;

        $pdf = PDF::loadView('pendaftaran.cetak', compact('datapendaftaran', 'no'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'portrait');
        return $pdf->stream('pendaftaran.pdf');
    }
}
