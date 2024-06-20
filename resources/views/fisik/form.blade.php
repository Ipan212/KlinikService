<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-toggle="validator">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalForm">Tambah Data Pemeriksaan Fisik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_pasien" class="control-label">Nama Pasien</label>
                        <select name="id_pasien" class="form-control" required>
                            @foreach($pasien as $p)
                                <option value="{{ $p->id_pasien }}">{{ $p->nama_pasien }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="tinggi_badan" class="col-lg-2 col-lg-offset-1 control-label">Tinggi Badan</label>
                        <div class="col-lg-6">
                            <input type="text" name="tinggi_badan" id="tinggi_badan" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berat_badan" class="col-lg-2 col-lg-offset-1 control-label">Berat Badan</label>
                        <div class="col-lg-6">
                            <input type="text" name="berat_badan" id="berat_badan" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tekanan_darah" class="col-lg-2 col-lg-offset-1 control-label">Tekanan Darah</label>
                        <div class="col-lg-6">
                            <input type="text" name="tekanan_darah" id="tekanan_darah" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penyakit_bawaan" class="col-lg-2 col-lg-offset-1 control-label">Penyakit Bawaan</label>
                        <div class="col-lg-6">
                            <input type="text" name="penyakit_bawaan" id="penyakit_bawaan" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
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
