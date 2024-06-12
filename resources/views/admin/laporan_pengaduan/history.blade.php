@extends('admin.layouts.template')
@section('title', 'Admin | Laporan Pengaduan')

@section('content')

    <div class="app-main flex-column flex-row-fluid mt-5 mx-5 mb-5" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('admin.layouts.breadcrumb')
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <div class="row">
                                @php $no = 1 @endphp
                                @foreach ($laporansP as $lp)
                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column mb-5">
                                        <div class="card card-flush py-4 flex-row-fluid">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <div class="card-title m-0">
                                                    <h3><b>Jenis Laporan: {{ $lp->jenis_laporan }}</b></h3>
                                                </div>
                                                <div class="card-toolbar">
                                                    <span
                                                        class="badge badge-{{ $lp->status == 'diterima'
                                                            ? 'light-success'
                                                            : ($lp->status == 'ditolak'
                                                                ? 'light-danger'
                                                                : ($lp->status == 'diproses'
                                                                    ? 'light-warning'
                                                                    : ($lp->status == 'selesai'
                                                                        ? 'light-primary'
                                                                        : ($lp->status == 'menunggu'
                                                                            ? 'light-info'
                                                                            : '')))) }} fw-bold px-4 py-3">
                                                        {{ ucfirst($lp->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>{{ $lp->warga->nama }}</b></h2>
                                                            <p class="text-muted text-sm"><b>Judul: </b> {{ $lp->judul }}
                                                            </p>
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-calendar"></i></span> Tanggal
                                                                    Laporan: {{ $lp->created_at->format('l, d F Y') }}</li>
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-sticky-note"></i></span>
                                                                    Keterangan: {{ $lp->keterangan }}</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            <img src="{{ asset($lp->gambar) }}" alt="Gambar Laporan"
                                                                class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
        <!--begin::Footer-->
        @include('admin.layouts.footer')
        <!--end::Footer-->
    </div>

@endsection
