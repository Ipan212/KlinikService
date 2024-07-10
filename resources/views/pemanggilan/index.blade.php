@extends('layout.master')

@section('title')
    Pemanggilan Pasien
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pemanggilan Pasien</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pasien Menunggu</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="4%">No</th>
                            <th width="20%">Kode Pasien</th>
                            <th width="25%">Nama Pasien</th>
                            <th width="25%">Nama Klinik</th>
                            <th width="15%">Nomor Antrian</th>
                            <th width="10%">Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($pendaftaran as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->pasien->kode_pasien }}</td>
                                    <td>{{ $p->pasien->nama_pasien }}</td>
                                    <td>{{ $p->klinik->nama_klinik }}</td>
                                    <td>{{ $p->nomor_antrian }}</td>
                                    <td>
                                        <button onclick="panggilPasien('{{ $p->id_pendaftaran }}', '{{ $p->pasien->nama_pasien }}', '{{ $p->nomor_antrian }}')" class="btn btn-xs btn-primary">
                                            <i class="fa fa-bullhorn"></i> Panggil
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Tabel Data Pasien yang Sudah Dipanggil -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pasien yang Sudah Dipanggil</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered" id="calledPatientsTable">
                        <thead>
                            <th width="4%">No</th>
                            <th width="20%">Kode Pasien</th>
                            <th width="25%">Nama Pasien</th>
                            <th width="25%">Nama Klinik</th>
                            <th width="15%">Nomor Antrian</th>
                            <th width="10%">Aksi</th>
                        </thead>
                        <tbody>
                            <!-- Data akan diisi melalui DataTable -->
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@endsection

@push('script')
<script>
function panggilPasien(id, namaPasien, nomorAntrian) {
    $.post('{{ route('pemanggilan.panggil') }}', {
        _token: '{{ csrf_token() }}',
        id_pendaftaran: id
    })
    .done(function(response) {
        alert(response.message);
        speakText("Nomor antrian " + nomorAntrian + ", atas nama " + namaPasien + ", harap menuju ke ruangan pemeriksaan.");
        location.reload();
    })
    .fail(function(xhr) {
        alert('Terjadi kesalahan');
    });
}

function speakText(text) {
    var msg = new SpeechSynthesisUtterance();
    msg.text = text;
    msg.lang = 'id-ID';
    window.speechSynthesis.speak(msg);
}

$(function () {
    // Initialize the DataTable for the "Called Patients" table
    $('#calledPatientsTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('pemanggilan.called_patients') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'kode_pasien'},
            {data: 'nama_pasien'},
            {data: 'klinik'},
            {data: 'nomor_antrian'},
            {data: 'aksi', searchable: false, sortable: false},  // Kolom aksi
        ]
    });

    // Handle call again button
    $(document).on('click', '.call-again-btn', function () {
        const idPendaftaran = $(this).data('id');
        $.post('{{ route('pemanggilan.call_again') }}', {
            _token: '{{ csrf_token() }}',
            id_pendaftaran: idPendaftaran
        })
        .done(function(response) {
            alert('Pasien dipanggil lagi dengan nomor antrian baru: ' + response.nomor_antrian);
            $('#calledPatientsTable').DataTable().ajax.reload();
            $('.table').DataTable().ajax.reload();
        })
        .fail(function(xhr) {
            alert('Gagal memanggil pasien lagi.');
        });
    });
});
</script>
@endpush
