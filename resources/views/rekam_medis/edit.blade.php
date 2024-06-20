@extends('layout.master')

@section('content')
<div class="container">
    <h1>Edit Rekam Medis</h1>
    <form action="{{ route('rekam_medis.update', $rekam_medi->id_rekam_medis) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_pasien">Nama Pasien</label>
            <select name="id_pasien" id="id_pasien" class="form-control">
                @foreach ($pasiens as $pasien)
                    <option value="{{ $pasien->id_pasien }}" {{ $pasien->id_pasien == $rekam_medi->id_pasien ? 'selected' : '' }}>
                        {{ $pasien->kode_pasien }} - {{ $pasien->nama_pasien }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa" id="diagnosa" class="form-control">{{ $rekam_medi->diagnosa }}</textarea>
        </div>
        <div class="form-group">
            <label for="id_jespem">Jenis Pemeriksaan</label>
            <select name="id_jespem" id="id_jespem" class="form-control">
                @foreach ($jenis_pemeriksaans as $jenis_pemeriksaan)
                    <option value="{{ $jenis_pemeriksaan->id_jespem }}" {{ $jenis_pemeriksaan->id_jespem == $rekam_medi->id_jespem ? 'selected' : '' }}>
                        {{ $jenis_pemeriksaan->nama_jespem }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="instruksi_khusus">Instruksi Khusus</label>
            <textarea name="instruksi_khusus" id="instruksi_khusus" class="form-control">{{ $rekam_medi->instruksi_khusus }}</textarea>
        </div>
        <div class="form-group">
            <label for="rujukan">Rujukan</label>
            <textarea name="rujukan" id="rujukan" class="form-control">{{ $rekam_medi->rujukan }}</textarea>
        </div>
        <div class="form-group">
            <label for="resep_obat">Resep Obat</label>
            <div id="resep-container">
                @foreach ($rekam_medi->obats as $obat)
                    <div class="resep-obat">
                        <select name="id_obat[]" class="form-control">
                            @foreach ($obats as $item)
                                <option value="{{ $item->id_obat }}" {{ $item->id_obat == $obat->id_obat ? 'selected' : '' }}>
                                    {{ $item->nama_obat }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="dosis[]" placeholder="Dosis" class="form-control" value="{{ $obat->pivot->dosis }}">
                        <input type="text" name="frekuensi[]" placeholder="Frekuensi" class="form-control" value="{{ $obat->pivot->frekuensi }}">
                        <input type="text" name="durasi[]" placeholder="Durasi" class="form-control" value="{{ $obat->pivot->durasi }}">
                        <button type="button" class="btn btn-danger remove-obat">Hapus</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-obat" class="btn btn-primary">Tambah Obat</button>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection

@push('script')
<script>
document.getElementById('add-obat').addEventListener('click', function() {
    var container = document.getElementById('resep-container');
    var newObat = container.firstElementChild.cloneNode(true);
    newObat.querySelector('select').value = '';
    newObat.querySelector('input[name="dosis[]"]').value = '';
    newObat.querySelector('input[name="frekuensi[]"]').value = '';
    newObat.querySelector('input[name="durasi[]"]').value = '';
    container.appendChild(newObat);
});

document.getElementById('resep-container').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-obat')) {
        e.target.parentElement.remove();
    }
});
</script>
@endpush
