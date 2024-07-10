@extends('layout.master')

@section('title')
Daftar Pasien
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Daftar Pasien</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pasien</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="4%">No</th>
                                <th>Nama Pasien</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->nama_pasien }}</td>
                                    <td>
                                        <button onclick="showRekamMedis({{ $p->id }})" class="btn btn-info btn-xs">Show</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-rekam-medis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Riwayat Rekam Medis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
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
                        <tbody id="rekam-medis-table">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    function showRekamMedis(id) {
    let url = "{{ url('/pasien') }}/" + id + "/rekam_medis";

    $.get(url, function(data) {
        let rows = '';
        data.forEach((rekamMedis, index) => {
            let obatList = rekamMedis.obats.map(obat => `${obat.nama_obat} (Dosis: ${obat.pivot.dosis}, Frekuensi: ${obat.pivot.frekuensi}, Durasi: ${obat.pivot.durasi})`).join('<br>');
            rows += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${rekamMedis.diagnosa}</td>
                    <td>${rekamMedis.jenisPemeriksaan ? rekamMedis.jenisPemeriksaan.nama_jespem : ''}</td>
                    <td>${rekamMedis.instruksi_khusus}</td>
                    <td>${rekamMedis.rujukan}</td>
                    <td>${obatList}</td>
                </tr>
            `;
        });
        $('#rekam-medis-table').html(rows);
        $('#modal-rekam-medis').modal('show');
    });
}

</script>
@endpush
