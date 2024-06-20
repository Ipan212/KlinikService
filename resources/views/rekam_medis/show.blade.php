@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white" style="justify-content: center">
                    <h3 class="card-title">Detail Rekam Medis</h3>
                    <h3 class="card-title">Klinik Al-Basmallah</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Kode Pasien:</strong> {{ $rekamMedis->pasien->kode_pasien }}</p>
                            <p><strong>Nama Pasien:</strong> {{ $rekamMedis->pasien->nama_pasien }}</p>
                            <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
                            <p><strong>Jenis Pemeriksaan:</strong> {{ $rekamMedis->jenisPemeriksaan->nama_jespem ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Instruksi Khusus:</strong> {{ $rekamMedis->instruksi_khusus }}</p>
                            <p><strong>Rujukan:</strong> {{ $rekamMedis->rujukan }}</p>
                        </div>
                    </div>

                    <hr>

                    <h4>Resep Obat</h4>
                    <ul class="list-group">
                        @foreach ($rekamMedis->obats as $obat)
                            <li class="list-group-item">
                                <strong>Nama Obat:</strong> {{ $obat->nama_obat }}<br>
                                <strong>Dosis:</strong> {{ $obat->pivot->dosis }}<br>
                                <strong>Frekuensi:</strong> {{ $obat->pivot->frekuensi }}<br>
                                <strong>Durasi:</strong> {{ $obat->pivot->durasi }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <a href="{{ route('rekam_medis.edit', $rekamMedis->id_rekam_medis) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('rekam_medis.destroy', $rekamMedis->id_rekam_medis) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <button onclick="window.print();" class="btn btn-success">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    @media print {
        .card-footer,
        .btn-success {
            display: none !important;
        }
    }
</style>
@endsection
