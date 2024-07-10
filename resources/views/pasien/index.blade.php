@extends('layout.master')
@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('pasien.store') }}')" class="btn btn-success btn-xs btn-flat rounded-lg">
                        <i class="fas fa-plus-circle"> Tambah</i>
                    </button>
                    <button onclick="cetakPasien('{{ route('pasien.cetak_pasien') }}')" class="btn btn-info btn-xs btn-flat">
                        <i class="fa fa-id-card"></i> Cetak Kartu Pasien
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <form action="" method="post" class="form-pasien">
                        @csrf
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="4%">No</th>
                                <th width="12%">Kode</th>
                                <th width="17%">Nama</th>
                                <th width="15%">Jenis Kelamin</th>
                                <th width="15%">Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th width="16%">No Telp</th>
                                <th width="10%">Aksi</th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@includeIf('pasien.form')
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
                url: '{{ route('pasien.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_pasien'},
                {data: 'nama_pasien'},
                {data: 'jenis_kelamin'},
                {data: 'tanggal_lahir'},
                {data: 'alamat'},
                {data: 'no_telp'},
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
        $('#modal-form .modal-title').text('Tambah Data Pasien');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_pasien]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Pasien');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_pasien]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_pasien]').val(response.nama_pasien);
                $('#modal-form [name=id_pasien]').val(response.id_pasien);
                $('#modal-form [name=kode_pasien]').val(response.kode_pasien);
                $('#modal-form [name=jenis_kelamin]').val(response.jenis_kelamin);
                $('#modal-form [name=tanggal_lahir]').val(response.tanggal_lahir);
                $('#modal-form [name=alamat]').val(response.alamat);
                $('#modal-form [name=no_telp]').val(response.no_telp);
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

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, $('.form-pasien').serialize())
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        } else {
            alert('Pilih data yang akan dihapus');
            return;
        }
    }

    function cetakPasien(url) {
        if ($('input:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else {
            $('.form-pasien')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>
@endpush
