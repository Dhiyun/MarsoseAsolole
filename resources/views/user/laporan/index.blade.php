@extends('user.layouts.template')
@section('title', 'Marsose | Laporan Warga')

@section('content')
<div class="row g-4">
    <div class="col-xl-5">
        <div class="card mt-0 h-100 shadow keluhan" style="background-image: url('assets/media/logos/rhone.svg'); ">
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="mb-2 text-dark pt-10" style="font-size: 24px; padding-bottom: 12px; font-weight: bold;">Laporkan Keluhan</span>
                    <span class="text-muted fw-semibold" style="font-size: 16px;">Anda dapat melaporkan segala bentuk</span>
                    <span class="text-muted fw-semibold" style="font-size: 16px;">keluhan anda di lingkungan marsose</span>
                    <span class="text-muted fw-semibold" style="font-size: 16px;">RW 03. Segera laporkan!</span>
                </h3>
            </div>
            <div class="card-body pt-5">
                <button class="btn laporan" onclick="window.location.href='{{ route('user-laporan.create') }}'">Buat Laporan</button>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card mt-0 h-100 shadow keluhan">
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">50</span>
                    <br>
                    <span class="text-gray-500 flex-grow-1 me-4">Jumlah Laporan Warga</span>
                </h3>
            </div>
            <div class="card-body pt-2 pb-4 d-flex align-items-center">
                <div class="d-flex flex-center me-5 pt-2">
                    <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="100" data-kt-line="11"></div>
                </div>
                <div class="d-flex flex-column content-justify-center w-100">
                    <div class="d-flex fs-6 fw-semibold align-items-center">
                        <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                        <div class="text-gray-500 flex-grow-1 me-4">Proses</div>
                        <div class="fw-bolder text-gray-700 text-xxl-end">9</div>
                    </div>
                    <div class="d-flex fs-6 fw-semibold align-items-center my-3">
                        <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                        <div class="text-gray-500 flex-grow-1 me-4">Ditolak</div>
                        <div class="fw-bolder text-gray-700 text-xxl-end">18</div>
                    </div>
                    <div class="d-flex fs-6 fw-semibold align-items-center">
                        <div class="bullet w-8px h-6px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                        <div class="text-gray-500 flex-grow-1 me-4">Diterima</div>
                        <div class="fw-bolder text-gray-700 text-xxl-end">12</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card mr-2 mt-0 h-100 shadow laporan">
            <div class="card-header align-items-center border-0 mt-4" style="width: 100%; text-align: center;">
                <h3 class="card-title align-items-center flex-column">
                    <span class="fw-bold mb-2" style="color: #38095D;">Riwayat <br>Laporan Anda</span>
                    <img src="assets/media/icons/laporan.svg" alt="Image" class="img-fluid mb-3 pt-lg-25" style="width: 200px; height: auto;">
                    <button class="btn btn-sm c-laporan" onclick="window.location.href='{{ route('user-laporan.history') }}'">Laporan Anda</button>
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="justify-content-center flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13 mt-10 keluhan" style="background-color: #fff;">
    <div class="my-2 me-5 text-left">
        <div class="fs-1 fs-m-2qx fw-bold d-inline-block">Data Laporan Pengaduan Warga</div>
        <hr style="border-top: 1px solid #000;">
    </div>

    <div class="row g-4">
        @if ($laporanPengaduan->isEmpty())
            <p class="text-center">Anda belum memiliki riwayat laporan pengaduan.</p>
        @else
            @foreach ($laporanPengaduan as $laporan)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow card-rounded" style="border-radius: 1.5em">
                        <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="{{ asset($laporan->gambar) }}">
                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px" style="background-image:url('{{ asset($laporan->gambar) }}')">
                                <span class="badge text-light bg-primary rounded-pill">{{ $laporan->jenis_laporan }}</span>
                            </div>
                            <div class="overlay-layer bg-dark bg-opacity-25">
                                <i class="ki-outline ki-eye fs-2x text-white"></i>
                            </div>
                        </a>
                        <div class="card-body m-0">
                            <h5 class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">{{ $laporan->judul }}</h5>
                            <p class="card-text fw-semibold text-gray-600">{{ $laporan->keterangan }}</p>
                            <div class="fs-6 fw-bold">
                                <span class="text-muted fw-light text-gray-800 mt-1">Pelapor:  </span><span class="fw-bold">{{ $laporan->warga->nama }} | <span class="fw-normal">{{ $laporan->created_at->format('d M Y') }}</span></span>
                                <span class="badge rounded-pill text-light
                                    @switch($laporan->status)
                                        @case('menunggu')
                                            bg-warning text-dark
                                            @break
                                        @case('diterima')
                                            bg-success
                                            @break
                                        @case('ditolak')
                                            bg-danger
                                            @break
                                        @case('diproses')
                                            bg-primary
                                            @break
                                        @case('selesai')
                                            bg-info
                                            @break
                                        @default
                                            bg-secondary
                                    @endswitch
                                ">{{ ucfirst($laporan->status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
