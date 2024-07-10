<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Yajra\DataTables\DataTables;

class PanggilanController extends Controller
{
    public function index()
    {
        $pendaftaran = Pendaftaran::with('pasien', 'klinik')
                        ->where('status', 'menunggu')
                        ->orderBy('nomor_antrian')
                        ->get();

        return view('pemanggilan.index', compact('pendaftaran'));
    }

    public function panggil(Request $request)
    {
        $pendaftaran = Pendaftaran::find($request->id_pendaftaran);
        $pendaftaran->status = 'dipanggil';
        $pendaftaran->save();

        return response()->json(['message' => 'Pasien dipanggil']);
    }

    public function calledPatientsData()
    {
        return DataTables::of(Pendaftaran::with('pasien', 'klinik')->where('status', 'dipanggil')->get())
            ->addIndexColumn()
            ->addColumn('kode_pasien', function ($data) {
                return $data->pasien->kode_pasien;
            })
            ->addColumn('nama_pasien', function ($data) {
                return $data->pasien->nama_pasien;
            })
            ->addColumn('klinik', function ($data) {
                return $data->klinik->nama_klinik;
            })
            ->addColumn('nomor_antrian', function ($data) {
                return $data->nomor_antrian;
            })
            ->addColumn('aksi', function ($data) {
                return '<button class="btn btn-warning btn-xs call-again-btn" data-id="' . $data->id_pendaftaran . '">Panggil Lagi</button>';
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }
    
    public function callAgain(Request $request)
    {
        $pendaftaran = Pendaftaran::find($request->id_pendaftaran);

        if ($pendaftaran) {
            // Update nomor antrian atau lakukan pemanggilan ulang sesuai kebutuhan
            $pendaftaran->status = 'menunggu';
            $pendaftaran->save();

            // Generate a new nomor antrian for the patient
            $newNomorAntrian = Pendaftaran::where('id_klinik', $pendaftaran->id_klinik)
                ->where('status', 'menunggu')
                ->count() + 1;

            $pendaftaran->nomor_antrian = $newNomorAntrian;
            $pendaftaran->save();

            return response()->json(['nomor_antrian' => $pendaftaran->nomor_antrian]);
        }

        return response()->json(['error' => 'Pendaftaran tidak ditemukan'], 404);
    }
}
