@extends('layout.master')

@section('content')
<div class="container">
    <h1>Daftar Transaksi</h1>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Total Biaya</th>
                <th>Obat</th>
                <th>Jenis Pemeriksaan</th>
                <th>Tanggal Transaksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaksi->pasien->nama_pasien }}</td>
                    <td>{{ number_format($transaksi->total_biaya, 2) }}</td>
                    <td>
                        @foreach($transaksi->obat as $obat)
                            {{ $obat->nama_obat }} ({{ $obat->pivot->jumlah }}),
                        @endforeach
                    </td>
                    <td>
                        @foreach($transaksi->pemeriksaan as $pemeriksaan)
                            {{ $pemeriksaan->nama_jespem }}<br>
                        @endforeach
                    </td>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                    <td>
                        <a href="{{ route('transaksi.show', $transaksi->id_transaksi) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('transaksi.edit', $transaksi->id_transaksi) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('transaksi.destroy', $transaksi->id_transaksi) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
