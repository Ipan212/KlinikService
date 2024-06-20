<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 300px;
            display: inline-block;
        }
        .card-header {
            font-size: 1.2em;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: center;
            background-color: #f8f8f8;
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        .card-body {
            padding: 10px;
        }
        .card-footer {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9em;
            color: #555;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    @foreach ($datapendaftaran as $chunk)
        @foreach ($chunk as $pendaftaran)
            <div class="card">
                <div class="card-header">
                    Kartu Pendaftaran
                </div>
                <div class="card-body">
                    <p>Nomor Antrian: {{ $pendaftaran->nomor_antrian }}</p>
                    <p>Nama Pasien: {{ $pendaftaran->pasien->nama_pasien }}</p>
                </div>
                <div class="card-footer">
                    <p>Nama Klinik: {{ $pendaftaran->klinik->nama_klinik }}</p>
                </div>
            </div>
        @endforeach
        <div class="page-break"></div>
    @endforeach
</body>
</html>
