@extends('user.layouts.template')
@section('title', 'Marsose | Riwayat Laporan Warga')

@section('content')
    <div class="container">
        <div class="card card-rounded shadow keluhan">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <div class="mb-5 text-center">
                    <h3 class="fs-2hx text-dark">Riwayat Laporan Anda</h3>
                    <div class="fs-5 text-muted fw-semibold">Berikut adalah riwayat laporan pengaduan Anda.</div>
                </div>
                <div class="row g-4">
                    @if ($laporanPengaduan->isEmpty())
                        <p class="text-center">Anda belum memiliki riwayat laporan pengaduan.</p>
                    @else
                        @foreach ($laporanPengaduan as $laporan)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow card-rounded" style="border-radius: 1.5em">
                                    <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                                        href="{{ asset($laporan->gambar) }}">
										
                                        <div class="overlay-wrapperbgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                            style="background-image:url('{{ asset($laporan->gambar) }}')"><span class="badge text-light bg-primary rounded-pill";">{{ $laporan->jenis_laporan }}</span></div>
                                        <div class="overlay-layer bg-dark bg-opacity-25">
                                            <i class="ki-outline ki-eye fs-2x text-white"></i>
                                        </div>	
                                    </a>
                                    <div class="card-body m-0">
                                        <h5 class="fs-4 text-dark fw-bold text-hover-warning text-dark lh-base">{{ $laporan->judul }}</h5>
                                        <p class="card-text fw-semibold text-gray-600">{{ $laporan->keterangan }}</p>
                                        <div class="fs-6 fw-bold">
                                            <span class="text-muted fw-bold mt-1">Dibuat pada:
                                                {{ $laporan->created_at->format('d M Y') }}</span>
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
											">{{ $laporan->status }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
