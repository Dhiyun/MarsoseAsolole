@extends('user.layouts.template')
@section('title', 'Marsose | Laporan Warga')

@section('content')
<!--begin::List Widget 5-->
<div class="row g-4">
    <div class="col-xl-5">
    
    <div class="card mt-0 h-100 shadow keluhan" style="background-image: url('assets/media/logos/rhone.svg'); ">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="mb-2 text-dark pt-10" style="font-size: 24px; padding-bottom: 12px; font-weight: bold;">Laporkan
                        Keluhan</span>
                    <span class="text-muted fw-semibold" style="font-size: 16px;">Anda dapat melaporkan segala <br>
                        bentuk
                        keluhan anda di lingkungan <br> marsose RW 03.</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                <button class="btn laporan"
                    onclick="window.location.href='/user/createlaporan'">Buat Laporan</button>
            </div>
            <!--end: Card Body-->
        </div>

    </div>

    <div class="col-xl-4">
        <div class="card mt-0 h-100 shadow keluhan">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">50</span>
                    <br>
                    <span class="text-gray-500 flex-grow-1 me-4">Jumlah Laporan Warga</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 pb-4 d-flex align-items-center">
                <!--begin::Chart-->
                <div class="d-flex flex-center me-5 pt-2">
                    <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="100"
                        data-kt-line="11"></div>
                </div>
                <!--end::Chart-->
                <!--begin::Labels-->
                <div class="d-flex flex-column content-justify-center w-100">
                    <!--begin::Label-->
                    <div class="d-flex fs-6 fw-semibold align-items-center">
                        <!--begin::Bullet-->
                        <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                        <!--end::Bullet-->
                        <!--begin::Label-->
                        <div class="text-gray-500 flex-grow-1 me-4">Proses</div>
                        <!--end::Label-->
                        <!--begin::Stats-->
                        <div class="fw-bolder text-gray-700 text-xxl-end">9</div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Label-->
                    <!--begin::Label-->
                    <div class="d-flex fs-6 fw-semibold align-items-center my-3">
                        <!--begin::Bullet-->
                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                        <!--end::Bullet-->
                        <!--begin::Label-->
                        <div class="text-gray-500 flex-grow-1 me-4">Ditolak</div>
                        <!--end::Label-->
                        <!--begin::Stats-->
                        <div class="fw-bolder text-gray-700 text-xxl-end">18</div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Label-->
                    <!--begin::Label-->
                    <div class="d-flex fs-6 fw-semibold align-items-center">
                        <!--begin::Bullet-->
                        <div class="bullet w-8px h-6px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                        <!--end::Bullet-->
                        <!--begin::Label-->
                        <div class="text-gray-500 flex-grow-1 me-4">Diterima</div>
                        <!--end::Label-->
                        <!--begin::Stats-->
                        <div class="fw-bolder text-gray-700 text-xxl-end">12</div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Label-->
                </div>
                <!--end::Labels-->
            </div>
            <!--end::Body-->
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card mr-2 mt-0 h-100 shadow laporan">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4" style="width: 100%; text-align: center;">
                <h3 class="card-title align-items-center flex-column">
                <span class="fw-bold mb-2" style="color: #38095D;">Riwayat <br>Laporan Anda</span>
                    <img src="assets/media/icons/laporan.svg" alt="Image" class="img-fluid mb-3 pt-lg-25"
                        style="width: 200px; height: auto;">
                    <button class="btn btn-sm c-laporan"
                        onclick="window.location.href='/user/createlaporan'">Laporan Anda</button>
                </h3>
            </div>
            <!--end::Header-->
        </div>
    </div>
</div>

<div class="justify-content-center flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13 mt-10 keluhan"
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
            <div class="card d-laporan" style="width: 18rem;">
                <div class="d-flex justify-content-center">
                    <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                        style="max-width: 100px;">
                </div>
                <div class="card-body">
                    <h4 class="card-title t-dlaporan"><b>Jalan Berlubang</b></h4>
                    <p class="card-text" style="font-size: 16px;">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                        style="cursor: pointer;">Proses</div>
                    <div class="position-absolute bottom-0 start-2 mb-2" style="font-size: 14px;">Irfan, 27 April 2024</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 position-relative">
            <div class="card d-laporan" style="width: 18rem;">
                <div class="d-flex justify-content-center">
                    <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                        style="max-width: 100px;">
                </div>
                <div class="card-body">
                    <h4 class="card-title t-dlaporan"><b>Jalan Berlubang</b></h4>
                    <p class="card-text" style="font-size: 16px;">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                        style="cursor: pointer;">Proses</div>
                    <div class="position-absolute bottom-0 start-2 mb-2" style="font-size: 14px;">Irfan, 27 April 2024</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 position-relative">
            <div class="card d-laporan" style="width: 18rem;">
                <div class="d-flex justify-content-center">
                    <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                        style="max-width: 100px;">
                </div>
                <div class="card-body">
                    <h4 class="card-title t-dlaporan"><b>Jalan Berlubang</b></h4>
                    <p class="card-text" style="font-size: 16px;">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                        style="cursor: pointer;">Proses</div>
                    <div class="position-absolute bottom-0 start-2 mb-2" style="font-size: 14px;">Irfan, 27 April 2024</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 position-relative">
            <div class="card d-laporan" style="width: 18rem;">
                <div class="d-flex justify-content-center">
                    <img src="assets/media/logos/gambar-city.svg" alt="Image" class="img-fluid mb-2 pt-lg-20"
                        style="max-width: 100px;">
                </div>
                <div class="card-body">
                    <h4 class="card-title t-dlaporan"><b>Jalan Berlubang</b></h4>
                    <p class="card-text" style="font-size: 16px;">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <div class="position-absolute bottom-0 end-0 mb-2 me-2 px-2 py-0 rounded bg-warning"
                        style="cursor: pointer;">Proses</div>
                    <div class="position-absolute bottom-0 start-2 mb-2" style="font-size: 14px;">Irfan, 27 April 2024</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection