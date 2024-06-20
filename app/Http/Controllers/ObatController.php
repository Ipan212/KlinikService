<?php
namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        return view('obat.index');
    }

    public function data()
    {
        $obat = Obat::orderBy('id_obat')->get();

        return datatables()
            ->of($obat)
            ->addIndexColumn()
            ->addColumn('select_all', function ($obat) {
                return '
                    <input type="checkbox" name="id_obat[]" value="'. $obat->id_obat .'">
                ';
            })
            ->addColumn('kode_obat', function ($obat) {
                return '<span class="label label-success">'. $obat->kode_obat .'</span>';
            })
            ->addColumn('harga', function ($obat) {
                return number_format($obat->harga, 0, ',', '.');
            })
            ->addColumn('stok', function ($obat) {
                return number_format($obat->stok, 0, ',', '.');
            })
            ->addColumn('aksi', function ($obat) {
                return '
                    <button type="button" onclick="editForm(`'. route('obat.update', $obat->id_obat) .'`)" class="btn btn-xs btn-info "><i class="fa fa-edit"></i></button>
                    <button type="button" onclick="deleteData(`'. route('obat.destroy', $obat->id_obat) .'`)" class="btn btn-xs btn-danger "><i class="fa fa-trash"></i></button>
                ';
            })
            ->rawColumns(['aksi', 'kode_obat', 'select_all'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kegunaan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $latestObat = Obat::latest()->first();
        $newId = $latestObat ? $latestObat->id_obat + 1 : 1;
        $request['kode_obat'] = 'P' . str_pad($newId, 6, '0', STR_PAD_LEFT);

        Obat::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function show($id)
    {
        $obat = Obat::find($id);

        return response()->json($obat);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'kegunaan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $obat = Obat::find($id);
        $obat->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    public function destroy($id)
    {
        $obat = Obat::find($id);
        $obat->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_obat as $id) {
            $obat = Obat::find($id);
            $obat->delete();
        }

        return response(null, 204);
    }
}
