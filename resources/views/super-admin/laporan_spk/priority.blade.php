<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prioritas Laporan SPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Prioritas Laporan SPK</h1>
        <a href="{{ route('laporan_spk.chart') }}" class="btn btn-success mb-3">Chart Prioritas</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Laporan</th>
                    <th>Biaya</th>
                    <th>Dampak</th>
                    <th>Durasi Pekerjaan</th>
                    <th>SDM</th>
                    <th>Total Score</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($sortedLaporans as $laporan)
                    <tr>
                        <td>{{ $laporan->id_spk }}</td>
                        <td>{{ $laporan->jenis_laporan }}</td>
                        <td>{{ $laporan->biaya }}</td>
                        <td>{{ $laporan->getSdmDescription() }}</td>
                        <td>{{ $laporan->durasi_pekerjaan }} hari</td>
                        <td>{{ $laporan->sdm }} orang</td>
                        <td>{{ $laporan->total_score }}</td>
                        <td>{{ $i++ }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('laporan_spk.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Laporan</a>
    </div>
</body>
</html>
