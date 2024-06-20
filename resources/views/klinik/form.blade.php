<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-toggle="validator">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Tambah Data Klinik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_klinik" class="control-label">Nama Klinik</label>
                        <input type="text" name="nama_klinik" class="form-control" required>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="control-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        <span class="help-block with-errors"></span>
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
