<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-toggle="validator">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Tambah Data Pendaftaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_pasien" class="control-label">Kode Pasien</label>
                        <select name="id_pasien" class="form-control" required>
                            @foreach($pasien as $p)
                                <option value="{{ $p->id_pasien }}">{{ $p->kode_pasien }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_klinik" class="control-label">Nama Klinik</label>
                        <select name="id_klinik" class="form-control" required>
                            @foreach($klinik as $k)
                                <option value="{{ $k->id_klinik }}">{{ $k->nama_klinik }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
