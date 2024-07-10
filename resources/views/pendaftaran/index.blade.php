@extends('layout.master')

@section('title')
    Daftar Pendaftaran
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Pendaftaran</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('pendaftaran.store') }}')" class="btn btn-success btn-xs btn-flat rounded-lg">
                        <i class="fas fa-plus-circle"> Daftar</i>
                    </button>
                    <button onclick="cetakPendaftaran('{{ route('pendaftaran.cetak_pendaftaran') }}')" class="btn btn-info btn-xs btn-flat">
                        <i class="fa fa-id-card"></i> Cetak Kartu Pendaftaran
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                <form action="" method="post" class="form-pendaftaran">
                    @csrf
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="4%">No</th>
                            <th width="20%">Kode Pasien</th>
                            <th width="25%">Nama Pasien</th>
                            <th width="25%">Nama Klinik</th>
                            <th width="15%">Nomor Antrian</th>
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
@includeIf('pendaftaran.form')
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
                url: '{{ route('pendaftaran.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_pasien'},
                {data: 'nama_pasien'},
                {data: 'klinik'},
                {data: 'nomor_antrian'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
    
        $('#modal-form').validator().on('submit', function (e) {
            if (!e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                        alert('Nomor Antrian: ' + response.nomor_antrian);
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
        $('#modal-form .modal-title').text('Tambah Data Pendaftaran');
    
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_pasien]').focus();
    }
    
    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Pendaftaran');
    
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
    
        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_pasien]').val(response.id_pasien);
                $('#modal-form [name=id_klinik]').val(response.id_klinik);
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
    
    function cetakPendaftaran(url) {
        if ($('input[name="id_pendaftaran[]"]:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else {
            $('.form-pendaftaran')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
    </script>
    
@endpush
