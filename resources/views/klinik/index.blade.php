@extends('layout.master')

@section('title')
    Daftar Klinik
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Klinik</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('klinik.store') }}')" class="btn btn-success btn-xs btn-flat rounded-lg">
                        <i class="fas fa-plus-circle"> Tambah</i>
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="4%">No</th>
                            <th width="25%">Nama Klinik</th>
                            <th width="45%">Alamat</th>
                            <th width="10%">Aksi</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
@includeIf('klinik.form')
@endsection

@push('script')
<script>
let table;

$(function () {
    table = $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: '{{ route('klinik.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama_klinik'},
            {data: 'alamat'},
            {data: 'aksi', searchable: false, sortable: false},
        ]
    });

    $('#modal-form').validator().on('submit', function (e) {
        if (!e.preventDefault()) {
            $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }
    });
});

function addForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Tambah Data Klinik');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('post');
    $('#modal-form [name=nama_klinik]').focus();
}

function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Data Klinik');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('put');
    $('#modal-form [name=nama_klinik]').focus();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=nama_klinik]').val(response.nama_klinik);
            $('#modal-form [name=alamat]').val(response.alamat);
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
            return;
        });
}

function deleteData(url) {
    if (confirm('Yakin ingin menghapus data terpilih?')) {
        $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                table.ajax.reload();
            })
            .fail((errors) => {
                alert('Tidak dapat menghapus data');
                return;
            });
    }
}
</script>
@endpush
