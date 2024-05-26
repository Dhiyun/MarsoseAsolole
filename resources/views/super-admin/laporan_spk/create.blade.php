<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan SPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Tambah Laporan SPK</h1>
        <form action="{{ route('laporan_spk.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="jenis_laporan" class="form-label">Jenis Laporan</label>
                <select class="form-select" id="jenis_laporan" name="jenis_laporan" required>
                    <option selected>-- Buka menu pilihan ini --</option>
                    <option value="Infrastruktur">Infrastruktur</option>
                    <option value="Keamanan">Keamanan</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Lingkungan">Lingkungan</option>
                    <option value="Layanan Masyarakat">Layanan Masyarakat</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="biaya" class="form-label">Biaya</label>
                <input type="number" class="form-control" id="biaya" name="biaya" required>
                <div id="biayaHelp" class="form-text">Silahkan masukkan nilai tanpa titik atau koma</div>
            </div>
            <div class="mb-3">
                <label for="dampak" class="form-label d-block">Dampak</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dampak" id="dampak1" value="1" required>
                    <label class="form-check-label" for="dampak1">Rendah</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dampak" id="dampak2" value="2" required>
                    <label class="form-check-label" for="dampak2">Medium</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dampak" id="dampak3" value="3" required>
                    <label class="form-check-label" for="dampak3">Tinggi</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="durasi_pekerjaan" class="form-label">Durasi Pekerjaan</label>
                <input type="number" class="form-control" id="durasi_pekerjaan" name="durasi_pekerjaan" required>
                <div id="durasiHelp" class="form-text">Silahkan masukkan per-hari</div>
            </div>
            <div class="mb-3">
                <label for="sdm" class="form-label">SDM</label>
                <input type="number" class="form-control" id="sdm" name="sdm" required>
                <div id="jumlah_pengaduanHelp" class="form-text">Silahkan pilih nilai 1, 2, 3 atau lebih</div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>

</html>
