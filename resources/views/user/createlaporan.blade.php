@extends('user.layouts.template')
@section('title', 'Marsose | Buat Laporan Warga')

@section('content')
<h1 class="mb-5 text-center fw-bold">Buat Laporan Warga</h1>
<div class="card shadow keluhan">
    <div class="card-body p-lg-17">
        <div class="d-flex flex-column mb-5 fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                <span class="required">Jenis Laporan</span>
                <span class="ms-1" data-bs-toggle="tooltip"
                    title="Your payment statements may very based on selected laporan">
                    <i class="ki-outline ki-information fs-7"></i>
                </span>
            </label>
            <!--end::Label-->
            <!--begin::Select-->
            <select name="laporan" data-control="select2" data-placeholder="Pilih Jenis Laporan..." class="form-select"
                style="border: 1px solid;">
                <option value="Laporan 1">Infrastruktur</option>
                <option value="Laporan 2">Keamanan</option>
                <option value="Laporan 3">Kesehatan</option>
                <option value="Laporan 4">Lingkungan</option>
                <option value="Laporan 5">Layanan Masyarakat</option>
            </select>
            <!--end::Select-->
        </div>
        <div class="d-flex flex-column mb-8">
            <label class="fs-6 fw-semibold mb-2">Deskripsi/Keterangan</label>
            <textarea class="form-control" rows="4" name="application" placeholder=""
                style="border: 1px solid;"></textarea>
        </div>
        <div class="d-flex flex-column mb-8">
            <label class="fs-6 fw-semibold mb-2">Dampak</label>
            <input type="text" class="form-control" name="application" placeholder="Jumlah orang terdampak" style="border: 1px solid;">
        </div>
        <div class="d-flex flex-column mb-5 fv-row">
            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                <span class="required">Gambar</span>
            </label>
            <div class="input-group">
                <input type="file" name="lampiran" class="form-control" style="border: 1px solid;" />
            </div>
            <div class="form-text">Catatan: Pastikan gambar bukti yang diunggah jelas dan mudah dibaca, tersedia
                dalam format JPG, PNG, atau GIF.</div>
            </div>
        </div>
        <div class="button-container mt-3">
            <button class="btn me-5 save-l">Save</button>
            <button class="btn cancel-l">Cancel</button>
        </div>
    </div>
</div>

@endsection