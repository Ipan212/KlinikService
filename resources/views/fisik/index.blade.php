@extends('layout.master')

@section('title')
    Data Pemerikaan Fisik
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Pemerikaan Fisik</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('fisik.store') }}')" class="btn btn-success btn-xs rounded-lg">
                        <i class="fas fa-plus-circle"> Tambah</i>
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                <form action="" method="post" class="form-fisik">
                    @csrf
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="4%">No</th>
                            <th width="15%">Nama Pasien</th>
                            <th width="10%">Tinggi Badan</th>
                            <th width="10%">Berat Badan</th>
                            <th width="10%">Tekanan Darah</th>
                            <th width="10%">Penyakit Bawaan</th>
                            <th width="10%">Aksi</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </form>
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row (main row) -->
@includeIf('fisik.form')
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
                url: '{{ route('fisik.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'pasien'},
                {data: 'tinggi_badan'},
                {data: 'berat_badan'},
                {data: 'tekanan_darah'},
                {data: 'penyakit_bawaan'},
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
    
        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });
    
    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Data Pemeriksaan Fisik');
    
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_pasien]').focus();
    }
    
    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Pemeriksaan Fisik');
    
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
    
        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_pasien]').val(response.id_pasien);
                $('#modal-form [name=tinggi_badan]').val(response.tinggi_badan);
                $('#modal-form [name=berat_badan]').val(response.berat_badan);
                $('#modal-form [name=tekanan_darah]').val(response.tekanan_darah);
                $('#modal-form [name=penyakit_bawaan]').val(response.penyakit_bawaan);
                $('#modal-form [name=id_pasien]').focus();
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
