@extends('layout.master')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Detail Transaksi</h1>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Struk Pembelian</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Nama Pasien:</strong> {{ $transaksi->pasien->nama_pasien }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <h5><strong>Obat:</strong></h5>
                <ul class="list-group">
                    @php $totalObat = 0; @endphp
                    @foreach($transaksi->obat as $obat)
                        @php $subtotalObat = $obat->pivot->jumlah * $obat->harga; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $obat->nama_obat }} ({{ $obat->pivot->jumlah }})
                            <span>Rp. {{ number_format($subtotalObat, 2) }}</span>
                        </li>
                        @php $totalObat += $subtotalObat; @endphp
                    @endforeach
                </ul>
                <p class="mt-2"><strong>Total Harga Obat:</strong> Rp. {{ number_format($totalObat, 2) }}</p>
            </div>

            <div class="mb-4">
                <h5><strong>Jenis Pemeriksaan:</strong></h5>
                <ul class="list-group">
                    @php $totalPemeriksaan = 0; @endphp
                    @foreach($transaksi->pemeriksaan as $pemeriksaan)
                        @php $totalPemeriksaan += $pemeriksaan->biaya; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $pemeriksaan->nama_jespem }}
                            <span>Rp. {{ number_format($pemeriksaan->biaya, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-2"><strong>Total Harga Pemeriksaan:</strong> Rp. {{ number_format($totalPemeriksaan, 2) }}</p>
            </div>

            <div class="mb-4">
                <h5><strong>Total Biaya:</strong></h5>
                <p class="h4">Rp. {{ number_format($transaksi->total_biaya, 2) }}</p>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali</a>
                <button onclick="window.print()" class="btn btn-secondary">Cetak</button>
            </div>
        </div>
    </div>
</div>
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection
