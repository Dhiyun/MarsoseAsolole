@extends('user.layouts.template')

@section('content')
<!--begin::List Widget 5-->
<div class="row g-4">
    <div class="col-xl-5">
        <div class="card mt-2 h-100"
            style="background-color: #FFFFF; background-image: url('assets/media/logos/rhone.svg'); background-repeat: no-repeat; background-size: cover;">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bold mb-2 text-dark pt-10" style="font-size: 24px; padding-bottom: 12px;">Laporkan
                        Keluhan</span>
                    <span class="text-muted fw-semibold" style="font-size: 16px;">Anda dapat melaporkan segala bentuk
                        keluhan anda di lingkungan marsose RW 03</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                <button class="btn" style="background-color: #F64E60; color:#fff;"
                    onclick="window.location.href='/user/createlaporan'">Buat Laporan</button>
            </div>
            <!--end: Card Body-->
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card mt-2 h-100">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bold mb-2 text-dark">Jumlah Laporan Warga</span>
                    <span class="text-muted fw-semibold fs-7">Langkah-langkah membuat laporan</span>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card mr-2 mt-2 h-100">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bold mb-2 text-dark">Riwayat Laporan</span>
                    <a href=""><img src="assets/media/icons/icon-surat.svg" alt="Image"
                            class="img-fluid mb-2 pt-lg-20"></a>
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="justify-content-center flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13 mt-10"
    style="background-color: #fff;">
    <!--begin::Content-->
    <div class="my-2 me-5 text-left">
        <div class="fs-1 fs-m-2qx fw-bold d-inline-block">Data Laporan Warga</div>
        <a href="/lihat-semua-laporan" class="btn btn-link float-end">Lihat Semua Laporan</a>
        <hr style="border-top: 1px solid #000;">
    </div>

    <!--end::Content-->

    <div class="row">
    <div class="col-xl-3 position-relative">
        <div class="card" style="width: 18rem;">
            <div class="d-flex justify-content-center">
                <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                    style="max-width: 100px;">
            </div>
            <div class="card-body">
                <h5 class="card-title">Jalan Berlubang</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
                <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                    style="cursor: pointer;">Proses</div>
                <div class="position-absolute bottom-0 start-2 mb-2">Irfan, 27 April 2024</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 position-relative">
        <div class="card" style="width: 18rem;">
            <div class="d-flex justify-content-center">
                <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                    style="max-width: 100px;">
            </div>
            <div class="card-body">
                <h5 class="card-title">Jalan Berlubang</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
                <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                    style="cursor: pointer;">Proses</div>
                <div class="position-absolute bottom-0 start-2 mb-2">Irfan, 27 April 2024</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 position-relative">
        <div class="card" style="width: 18rem;">
            <div class="d-flex justify-content-center">
                <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                    style="max-width: 100px;">
            </div>
            <div class="card-body">
                <h5 class="card-title">Jalan Berlubang</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
                <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                    style="cursor: pointer;">Proses</div>
                <div class="position-absolute bottom-0 start-2 mb-2">Irfan, 27 April 2024</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 position-relative">
        <div class="card" style="width: 18rem;">
            <div class="d-flex justify-content-center">
                <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                    style="max-width: 100px;">
            </div>
            <div class="card-body">
                <h5 class="card-title">Jalan Berlubang</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's content.</p>
                <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                    style="cursor: pointer;">Proses</div>
                <div class="position-absolute bottom-0 start-2 mb-2">Irfan, 27 April 2024</div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection