<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pasien;
use App\Models\Obat;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('pasien', 'obat', 'pemeriksaan')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $obats = Obat::all();
        $pemeriksaans = Pemeriksaan::all();
        return view('transaksi.create', compact('pasiens', 'obats', 'pemeriksaans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_obat' => 'required|array',
            'id_obat.*' => 'required|exists:obat,id_obat',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
            'id_jespem' => 'required|array',
            'id_jespem.*' => 'required|exists:pemeriksaan,id_jespem',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $transaksi = Transaksi::create([
            'id_pasien' => $request->id_pasien,
            'total_biaya' => 0,
            'tanggal_transaksi' => now(),
        ]);

        $total_biaya = 0;

        foreach ($request->id_obat as $index => $id_obat) {
            $jumlah = $request->jumlah[$index];
            $obat = Obat::find($id_obat);
            $total_biaya += $obat->harga * $jumlah;
            $transaksi->obat()->attach($id_obat, ['jumlah' => $jumlah]);
        }

        foreach ($request->id_jespem as $id_jespem) {
            $pemeriksaan = Pemeriksaan::find($id_jespem);
            $total_biaya += $pemeriksaan->biaya;
            $transaksi->pemeriksaan()->attach($id_jespem);
        }

        $transaksi->update(['total_biaya' => $total_biaya]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat');
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('pasien', 'obat', 'pemeriksaan')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('pasien', 'obat', 'pemeriksaan')->findOrFail($id);
        $pasiens = Pasien::all();
        $obats = Obat::all();
        $pemeriksaans = Pemeriksaan::all();
        return view('transaksi.edit', compact('transaksi', 'pasiens', 'obats', 'pemeriksaans'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'id_pasien' => $request->id_pasien,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        $transaksi->obat()->detach();
        $transaksi->pemeriksaan()->detach();

        $total_biaya = 0;

        foreach ($request->id_obat as $index => $id_obat) {
            $jumlah = $request->jumlah[$index];
            $obat = Obat::find($id_obat);
            $total_biaya += $obat->harga * $jumlah;
            $transaksi->obat()->attach($id_obat, ['jumlah' => $jumlah]);
        }

        foreach ($request->id_jespem as $id_jespem) {
            $pemeriksaan = Pemeriksaan::find($id_jespem);
            $total_biaya += $pemeriksaan->biaya;
            $transaksi->pemeriksaan()->attach($id_jespem);
        }

        $transaksi->update(['total_biaya' => $total_biaya]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
