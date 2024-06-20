<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Member</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card {
            width: 50%;
            height: 20%;
            background: rgb(35, 117, 171);
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .card-header {
            text-align: center;
            margin-bottom: 2px;
        }
        .card-data {
            margin-bottom: 2px;
            padding: 5px;
        }
        .card-data label {
            font-weight: bold;
            display: inline-block;
            width: 80px; 
        }
        .card-data p {
            margin: 0;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="cards-container">
        @foreach ($datapasien as $chunk)
            @foreach ($chunk as $pasien)
            <div class="card">
                <div class="card-header">
                    <h2>Klinik Al-Basmallah</h2>
                    <h3>Kartu Member</h3>
                </div>
                <div class="card-data">
                    <label>Nama:</label>
                    <p>{{ $pasien->nama_pasien }}</p>
                </div>
                <div class="card-data">
                    <label>Kode:</label>
                    <p>{{ $pasien->kode_pasien }}</p>
                </div>
                <div class="card-data">
                    <label>No Telp:</label>
                    <p>{{ $pasien->no_telp }}</p>
                </div>
            </div>
            @endforeach
        @endforeach
    </div>
</body>
</html>
