{{-- @extends('super-admin.layouts.template')

@section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="mt-5">Laporan SPK</h1>
            </div>
            <div class="col-md-6 mt-5 d-flex justify-content-end">
                <a href="{{ route('laporan_spk.create') }}" class="btn btn-primary mb-3 mx-1">
                    <i class="bi bi-plus-circle"></i> Tambah Laporan
                </a>
                <a href="{{ route('laporan_spk.priority') }}" class="btn btn-danger mb-3 mx-1">
                    <i class="bi bi-exclamation-circle"></i> Lihat Prioritas
                </a>
                <a href="{{ route('laporan_spk.chart') }}" class="btn btn-success mb-3 mx-1">
                    <i class="bi bi-bar-chart"></i> Chart Prioritas
                </a>
            </div>
        </div>             
        <h4 class="mt-3 text-center">Riwayat Laporan</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>Jenis Laporan</th>
                    <th>Biaya</th>
                    <th>Dampak</th>
                    <th>Durasi Pekerjaan</th>
                    <th>SDM</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporans as $laporan)
                    <tr>
                        {{-- <td>{{ $laporan->ID_SPK }}</td> --}}
                        <td>{{ $laporan->jenis_laporan }}</td>
                        <td>{{ $laporan->biaya }}</td>
                        <td>{{ $laporan->getSdmDescription() }}</td>
                        <td>{{ $laporan->durasi_pekerjaan }} hari</td>
                        <td>{{ $laporan->sdm }} orang</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

{{-- @endsection --}}
