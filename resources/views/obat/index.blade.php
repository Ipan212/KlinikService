@extends('layout.master')

@section('title')
    Data Obat
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Obat</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('obat.store') }}')" class="btn btn-success btn-xs btn-flat rounded-lg"><i class="fas fa-plus-circle"> Tambah</i></button>
                    <button onclick="deleteSelected('{{ route('obat.delete_selected') }}')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                </div>
                <div class="card-body table-responsive">
                    <form action="" method="post" class="form-obat">
                        @csrf
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="4%">No</th>
                                <th width="12%">Kode</th>
                                <th width="17%">Nama</th>
                                <th width="18%">Kegunaan</th>
                                <th width="15%">Harga</th>
                                <th width="14%">Stok</th>
                                <th width="10%">Aksi</th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@includeIf('obat.form') <!-- Include form modal here -->
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
                url: '{{ route('obat.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_obat'},
                {data: 'nama_obat'},
                {data: 'kegunaan'},
                {data: 'harga'},
                {data: 'stok'},
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
        $('#modal-form .modal-title').text('Tambah Data Obat');
    
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_obat]').focus();
    }
    
    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Obat');
    
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_obat]').focus();
    
        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_obat]').val(response.nama_obat);
                $('#modal-form [name=kegunaan]').val(response.kegunaan);
                $('#modal-form [name=harga]').val(response.harga);
                $('#modal-form [name=stok]').val(response.stok);
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
                $.post(url, $('.form-obat').serialize())
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

</script>
@endpush
