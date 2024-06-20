@extends('layout.master')

@section('title')
    Data  Pemeriksaan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Jenis Pemeriksaan</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('pemeriksaan.store') }}')" class="btn btn-success btn-xs btn-flat rounded-lg">
                        <i class="fas fa-plus-circle"></i> Tambah
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <form action="" method="post" class="form-pemeriksaan">
                        @csrf
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th width="4%">No</th>
                                <th width="20%">Nama</th>
                                <th width="15%">Biaya</th>
                                <th width="10%">Aksi</th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@includeIf('pemeriksaan.form') <!-- Sertakan modal form di sini -->
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
                url: '{{ route('pemeriksaan.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama_jespem'},
                {data: 'biaya'},
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
        $('#modal-form .modal-title').text('Tambah Data Jenis Pemeriksaan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_jespem]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data  Pemeriksaan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_jespem]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_jespem]').val(response.nama_jespem);
                $('#modal-form [name=biaya]').val(response.biaya);
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
