<div class="modal" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" class="form-horizontal">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 <div class="form-group">
                    <label for="nama_pasien">Nama Pasien</label>
                    <div >
                        <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" required autofocus>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div >
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telephone</label>
                        <div >
                            <input type="text" name="no_telp" id="no_telp" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <div >
                            <textarea name="alamat" id="alamat" class="form-control" required autofocus rows="3"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm ">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Batal</button>
                </div>
              </div>
        </form>
    </div>
  </div>