@extends('user.layouts.template')

@section('content')
<h1 class="mb-5">Buat Laporan Warga</h1>
<div class="card">
    <div class="card-body p-lg-17">
        <div class="d-flex flex-column mb-5 fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                <span class="required">Jenis Laporan</span>
                <span class="ms-1" data-bs-toggle="tooltip" title="Your payment statements may very based on selected laporan">
                    <i class="ki-outline ki-information fs-7"></i>
                </span>
            </label>
            <!--end::Label-->
            <!--begin::Select-->
            <select name="laporan" data-control="select2" data-placeholder="Pilih Jenis Laporan..." class="form-select" style="border: 1px solid;">
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
            <textarea class="form-control" rows="4" name="application" placeholder="" style="border: 1px solid;"></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card mt-5">
            <div class="card-body p-lg-17">
                <div class="d-flex flex-column mb-5 fv-row">
                    <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                        <span class="required">Gambar</span>
                    </label>
                    <div class="input-group">
                        <input type="file" name="lampiran" class="form-control" style="border: 1px solid;" />
                    </div>
                    <div class="form-text">Catatan: Pastikan gambar bukti yang diunggah jelas dan mudah dibaca, tersedia dalam format JPG, PNG, atau GIF.</div>
                </div>
            </div>            
        </div>
        <div class="mt-5">
            <button class="btn me-5" style="background-color: #D97706; color: #fff;">Save</button>
            <button class="btn" style="background-color: #fff; color: #000; border: 1px solid #D1D5DB;">Cancel</button>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card mt-5 h-100" style="background-color: #1E293B;">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bold mb-2 text-light">Alur Laporan</span>
                    <span class="text-muted fw-semibold fs-7">Langkah-langkah membuat laporan</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                <!--begin::Timeline-->
                <div class="timeline-label">
                    <!--begin::Item-->
                    <div class="timeline-item">
                        <!--begin::Label-->
                        <div class="timeline-label fw-bold text-light fs-6">Step 1</div>
                        <!--end::Label-->
                        <!--begin::Badge-->
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-info fs-1"></i>
                        </div>
                        <!--end::Badge-->
                        <!--begin::Text-->
                        <div class="fw-bold timeline-content text-light ps-3">Buka Fitur Laporan Warga <br>
                            <span class="text-muted fw-semibold">Akses fitur laporan yang tersedia.</span>
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="timeline-item">
                        <!--begin::Label-->
                        <div class="timeline-label fw-bold text-light fs-6">Step 2</div>
                        <!--end::Label-->
                        <!--begin::Badge-->
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-success fs-1"></i>
                        </div>
                        <!--end::Badge-->
                        <!--begin::Content-->
                        <div class="fw-bold timeline-content text-light ps-3">Isi Formulir Pengaduan <br>
                            <span class="text-muted fw-semibold">Lengkapi formulir dengan detail. Pastikan semua informasi diisi dengan jelas.</span>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="timeline-item">
                        <!--begin::Label-->
                        <div class="timeline-label fw-bold text-light fs-6">Step 3</div>
                        <!--end::Label-->
                        <!--begin::Badge-->
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-danger fs-1"></i>
                        </div>
                        <!--end::Badge-->
                        <!--begin::Desc-->
                        <div class="fw-bold timeline-content text-light ps-3">Proses Verifikasi <br>
                            <span class="text-muted fw-semibold">Laporan akan diverifikasi oleh RW untuk menentukan diterima atau ditolak.</span>
                        </div>
                        <!--end::Desc-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="timeline-item">
                        <!--begin::Label-->
                        <div class="timeline-label fw-bold text-light fs-6">Step 4</div>
                        <!--end::Label-->
                        <!--begin::Badge-->
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-primary fs-1"></i>
                        </div>
                        <!--end::Badge-->
                        <!--begin::Text-->
                        <div class="fw-bold timeline-content text-light ps-3">Tindak Lanjut dan Musyawarah <br>
                            <span class="text-muted fw-semibold">Jika diterima, laporan akan dibahas dalam musyawarah dengan RT, RW, dan warga terkait.</span>
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <div class="timeline-item">
                        <!--begin::Label-->
                        <div class="timeline-label fw-bold text-light fs-6">Step 5</div>
                        <!--end::Label-->
                        <!--begin::Badge-->
                        <div class="timeline-badge">
                            <i class="fa fa-genderless text-warning fs-1"></i>
                        </div>
                        <!--end::Badge-->
                        <!--begin::Desc-->
                        <div class="fw-bold timeline-content text-light ps-3">Penyelesaian <br>
                            <span class="text-muted fw-semibold">Setelah musyawarah, tindakan selanjutnya dilakukan untuk menyelesaikan laporan.</span>
                        </div>
                        <!--end::Desc-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Timeline-->
            </div>
            <!--end: Card Body-->
        </div>
    </div>
</div>

@endsection