@extends('layout.master')

@section('content')
<div class="container">
    <h1>Detail Transaksi</h1>
    <div class="card">
        <div class="card-header">
            <h3>Transaksi #{{ $transaksi->id_transaksi }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Nama Pasien:</strong> {{ $transaksi->pasien->nama_pasien }}</p>
            <p><strong>Total Biaya:</strong> {{ number_format($transaksi->total_biaya, 2) }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p>
            <p><strong>Obat:</strong></p>
            <ul>
                @foreach($transaksi->obat as $obat)
                    <li>{{ $obat->nama_obat }} ({{ $obat->pivot->jumlah }})</li>
                @endforeach
            </ul>
            <p><strong>Jenis Pemeriksaan:</strong></p>
            <ul>
                @foreach($transaksi->pemeriksaan as $pemeriksaan)
                    <li>{{ $pemeriksaan->nama_jespem }}</li>
                @endforeach
            </ul>
            <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection
