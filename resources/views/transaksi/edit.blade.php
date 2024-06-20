@extends('layout.master')

@section('content')
<div class="container">
    <h1>Edit Transaksi</h1>
    <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_pasien">Nama Pasien</label>
            <select name="id_pasien" id="id_pasien" class="form-control">
                @foreach($pasiens as $pasien)
                    <option value="{{ $pasien->id_pasien }}" {{ $transaksi->id_pasien == $pasien->id_pasien ? 'selected' : '' }}>
                        {{ $pasien->nama_pasien }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pemeriksaan">Jenis Pemeriksaan</label>
            <select name="id_jespem[]" id="pemeriksaan" class="form-control" multiple>
                @foreach($pemeriksaans as $pemeriksaan)
                    <option value="{{ $pemeriksaan->id_jespem }}" {{ in_array($pemeriksaan->id_jespem, $transaksi->pemeriksaan->pluck('id_jespem')->toArray()) ? 'selected' : '' }}>
                        {{ $pemeriksaan->nama_jespem }} - {{ number_format($pemeriksaan->biaya, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="obat">Obat</label>
            <div id="obat-container">
                @foreach($transaksi->obat as $obat)
                    <div class="obat-item mt-2">
                        <select name="id_obat[]" class="form-control mb-2">
                            @foreach($obats as $o)
                                <option value="{{ $o->id_obat }}" {{ $obat->id_obat == $o->id_obat ? 'selected' : '' }}>
                                    {{ $o->nama_obat }} - {{ number_format($o->harga, 2) }}
                                </option>
                            @endforeach
                        </select>
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah[]" class="form-control mb-2" min="1" value="{{ $obat->pivot->jumlah }}">
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
