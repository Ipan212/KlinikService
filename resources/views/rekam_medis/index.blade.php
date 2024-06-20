@extends('layout.master')

@section('content')
<div class="container">
    <h1>Daftar Rekam Medis</h1>
    <a href="{{ route('rekam_medis.create') }}" class="btn btn-primary">Buat Rekam Medis Baru</a>
    <form action="{{ route('rekam_medis.index') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Cari Nama/Kode Pasien" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Pasien</th>
                <th>Nama Pasien</th>
                <th>Diagnosa</th>
                <th>Jenis Pemeriksaan</th>
                <th>Instruksi Khusus</th>
                <th>Rujukan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekamMedis as $index => $rekam)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $rekam->pasien->kode_pasien }}</td> 
                <td>{{ $rekam->pasien->nama_pasien }}</td>
                <td>{{ $rekam->diagnosa }}</td>
                <td>{{ $rekam->jenisPemeriksaan->nama_jespem ?? 'N/A' }}</td>
                <td>{{ $rekam->instruksi_khusus }}</td>
                <td>{{ $rekam->rujukan }}</td>
                <td>
                    <a href="{{ route('rekam_medis.show', $rekam->id_rekam_medis) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('rekam_medis.edit', $rekam->id_rekam_medis) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('rekam_medis.destroy', $rekam->id_rekam_medis) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
