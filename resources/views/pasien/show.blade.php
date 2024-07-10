@extends('layout.master')

@section('title')
    Detail Pasien {{ $pasien->nama_pasien }}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Detail Pasien</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3>Rekam Medis - {{ $pasien->nama_pasien }}</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Diagnosa</th>
                        <th>Jenis Pemeriksaan</th>
                        <th>Instruksi Khusus</th>
                        <th>Rujukan</th>
                        <th>Obat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekamMedis as $index => $medis)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $medis->diagnosa }}</td>
                        <td>{{ $medis->jenisPemeriksaan->nama_jespem }}</td>
                        <td>{{ $medis->instruksi_khusus }}</td>
                        <td>{{ $medis->rujukan }}</td>
                        <td>
                            <ul>
                                @foreach ($medis->obats as $obat)
                                    <li>{{ $obat->nama_obat }} (Dosis: {{ $obat->pivot->dosis }}, Frekuensi: {{ $obat->pivot->frekuensi }}, Durasi: {{ $obat->pivot->durasi }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <h3>Pemeriksaan Fisik - {{ $pasien->nama_pasien }}</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tinggi Badan</th>
                        <th>Berat Badan</th>
                        <th>Tekanan Darah</th>
                        <th>Penyakit Bawaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemeriksaanFisik as $index => $fisik)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $fisik->tinggi_badan }}</td>
                        <td>{{ $fisik->berat_badan }}</td>
                        <td>{{ $fisik->tekanan_darah }}</td>
                        <td>{{ $fisik->penyakit_bawaan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
