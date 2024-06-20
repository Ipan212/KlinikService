@extends('layout.master')

@section('content')

<div class="container">
    <h1>Tambah Transaksi</h1>
    <div class="search" dis>
        <div class="form-group">
            <label for="search_pasien" class="col-lg-2 col-lg-offset-1 control-label">Cari Pasien</label>
            <select id="search_pasien" class="form-control col-lg-6">
                <option value="">Pilih Pasien</option>
                @foreach($pasiens as $pasien)
                    <option value="{{ $pasien->id_pasien }}" data-nama="{{ $pasien->nama_pasien }}">{{ $pasien->nama_pasien }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="search_obat" class="col-lg-2 col-lg-offset-1 control-label">Cari Obat</label>
            <select id="search_obat" class="form-control col-lg-6">
                <option value="">Pilih Obat</option>
                @foreach($obats as $obat)
                    <option value="{{ $obat->id_obat }}" data-harga="{{ $obat->harga }}" data-nama="{{ $obat->nama_obat }}">{{ $obat->nama_obat }}</option>
                @endforeach
            </select>
        </div>
    </div>
    

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_pasien">Nama Pasien</label>
            <select name="id_pasien" id="id_pasien" class="form-control">
                <option>pilih pasien</option>
                @foreach($pasiens as $pasien)
                    <option value="{{ $pasien->id_pasien }}">{{ $pasien->nama_pasien }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pemeriksaan">Jenis Pemeriksaan</label>
            <select name="id_jespem[]" id="pemeriksaan" class="form-control">
                <option>pilih jenis pemeriksaan</option>
                @foreach($pemeriksaans as $pemeriksaan)
                    <option value="{{ $pemeriksaan->id_jespem }}" data-biaya="{{ $pemeriksaan->biaya }}">{{ $pemeriksaan->nama_jespem }} - {{ number_format($pemeriksaan->biaya, 2) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="obat">Obat</label>
            <div id="obat-container">
                <div class="obat-item">
                    <select name="id_obat[]" class="form-control mb-2">
                        <option>pilih obat</option>
                        @foreach($obats as $obat)
                            <option value="{{ $obat->id_obat }}" data-harga="{{ $obat->harga }}">{{ $obat->nama_obat }} - {{ number_format($obat->harga, 2) }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah[]" class="form-control mb-2" placeholder="Jumlah" min="1">
                    <button type="button" class="btn btn-danger remove-obat">Hapus</button>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="add-obat">Tambah Obat</button>
        </div>
        <div class="form-group">
            <label for="total_biaya">Total Biaya</label>
            <input type="text" id="total_biaya" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@push('script')

<script>
$(document).ready(function() {
    $('#search_pasien').select2();
    $('#search_obat').select2();

    $('#search_pasien').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var pasienId = selectedOption.val();
        $('#id_pasien').val(pasienId).trigger('change');
    });

    $('#search_obat').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var obatId = selectedOption.val();
        var obatName = selectedOption.data('nama');
        var obatHarga = selectedOption.data('harga');

        var container = $('#obat-container');
        var newObat = container.find('.obat-item').first().clone();
        newObat.find('select').val(obatId);
        newObat.find('input[name="jumlah[]"]').val(1); // Default to 1
        newObat.find('.remove-obat').on('click', function() {
            newObat.remove();
            calculateTotalBiaya();
        });
        newObat.find('select').on('change', calculateTotalBiaya);
        newObat.find('input[name="jumlah[]"]').on('input', calculateTotalBiaya);

        container.append(newObat);
        calculateTotalBiaya();
    });

    $('#add-obat').on('click', function() {
        var container = $('#obat-container');
        var newObat = container.find('.obat-item').first().clone();
        newObat.find('select').val('');
        newObat.find('input[name="jumlah[]"]').val('');
        newObat.find('.remove-obat').on('click', function() {
            newObat.remove();
            calculateTotalBiaya();
        });
        newObat.find('select').on('change', calculateTotalBiaya);
        newObat.find('input[name="jumlah[]"]').on('input', calculateTotalBiaya);
        container.append(newObat);
    });

    $('#pemeriksaan').on('change', calculateTotalBiaya);
    $('#obat-container').on('change', 'select', calculateTotalBiaya);
    $('#obat-container').on('input', 'input[name="jumlah[]"]', calculateTotalBiaya);

    function calculateTotalBiaya() {
        let totalBiaya = 0;

        // Calculate biaya pemeriksaan
        const pemeriksaanSelect = $('#pemeriksaan');
        pemeriksaanSelect.find('option:selected').each(function() {
            totalBiaya += parseFloat($(this).data('biaya'));
        });

        // Calculate biaya obat
        $('#obat-container .obat-item').each(function() {
            const select = $(this).find('select');
            const input = $(this).find('input[name="jumlah[]"]');
            const harga = parseFloat(select.find('option:selected').data('harga'));
            const jumlah = parseInt(input.val()) || 0; // If input is empty, consider it as 0
            totalBiaya += harga * jumlah;
        });

        $('#total_biaya').val(totalBiaya.toFixed(2));
    }

    // Initial calculation
    calculateTotalBiaya();
});
</script>
@endpush
