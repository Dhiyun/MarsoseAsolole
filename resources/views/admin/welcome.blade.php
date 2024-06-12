@extends('admin.layouts.template')
@section('title', 'Admin | Dashboard')

@section('content')

<div id="kt_app_content_container" class="container-fluid app-container">
    <div class="px-4 px-sm-6 px-lg-8 py-8">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
			<!--begin::Welcome Banner-->
            <div id="welcome-banner" class="position-relative bg-indigo p-4 p-sm-4 rounded-sm overflow-hidden mb-10">
                <div class="position-relative bg-indigo-300 p-4 rounded mb-4">
                    <!-- Background illustration -->
                    <div class="position-absolute end-0 top-0 me-4 d-none d-xl-block" style="opacity: 0.5;">
                        <svg width="319" height="198">
                            <defs>
                                <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                                <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                                <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                                <linearGradient id="welcome-b" x1="50%" y1="0%" x2="50%" y2="100%">
                                    <stop offset="0%" style="stop-color: #A5B4FC;" />
                                    <stop offset="100%" style="stop-color: #818CF8;" />
                                </linearGradient>
                                <linearGradient id="welcome-c" x1="50%" y1="24.537%" x2="50%" y2="100%">
                                    <stop offset="0%" style="stop-color: #4338CA;" />
                                    <stop offset="100%" style="stop-color: #6366F1; stop-opacity: 0;" />
                                </linearGradient>
                            </defs>
                            <g fill="none">
                                <g transform="rotate(64 36.592 105.604)">
                                    <mask id="welcome-d" fill="#fff">
                                        <use href="#welcome-a" />
                                    </mask>
                                    <use fill="url(#welcome-b)" href="#welcome-a" />
                                    <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                                </g>
                                <g transform="rotate(-51 91.324 -105.372)">
                                    <mask id="welcome-f" fill="#fff">
                                        <use href="#welcome-e" />
                                    </mask>
                                    <use fill="url(#welcome-b)" href="#welcome-e" />
                                    <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                                </g>
                                <g transform="rotate(44 61.546 392.623)">
                                    <mask id="welcome-h" fill="#fff">
                                        <use href="#welcome-g" />
                                    </mask>
                                    <use fill="url(#welcome-b)" href="#welcome-g" />
                                    <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                                </g>
                            </g>
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="position-relative">
                        <h1 id="banner-font-h" class="d-flex align-items-center text-dark mb-5">Selamat Datang, 
                            {{ $user->warga->nama }}
                        </h1>
                        <p id="banner-font-p" class="text-indigo-200">Berikut Laporan Untuk Hari Ini :</p>
                    </div>
                </div>
            </div>
			<!--end::Welcome Banner-->

			<!--begin::Row-->
			<div class="row">
				<!-- Kolom pertama -->
				<div class="col-12 col-sm-4 col-xl-4 mb-4 d-flex flex-column">
					<div class="card h-100 shadow-sm border-gradient border-gradient-red">
						<div class="card-body">
							<header class="d-flex justify-content-between align-items-start mb-2">
								<!-- Icon -->
								<img alt="Icon" src="assets/media/icons/icon-02.svg" width="32"
									height="32" />
							</header>
							<h2 class="d-flex align-items-center text-dark mb-5">Total Laporan</h2>
							<div class="text-muted text-uppercase mb-1">Total</div>
							<div class="d-flex align-items-start">
								<div class="fs-3 fw-bold text-slate-800 dark:text-slate-100 me-2">{{ $totalLaporan }}
								</div>
								{{-- <div class="badge bg-green-500">+</div> --}}
							</div>
						</div>
					</div>
				</div>

				<!-- Kolom kedua -->
				<div class="col-12 col-sm-4 col-xl-4 mb-4 d-flex flex-column">
					<div class="card h-100 shadow-sm border-gradient border-gradient-yellow">
						<div class="card-body">
							<header class="d-flex justify-content-between align-items-start mb-2">
								<!-- Icon -->
								<img alt="Icon" src="assets/media/icons/icon-01.svg" width="32"
									height="32" />
							</header>
							<h2 class="d-flex align-items-center text-dark mb-5">Jumlah Warga RT</h2>
							<div class="text-muted text-uppercase mb-1">Warga</div>
							<div class="d-flex align-items-start">
								<div class="fs-3 fw-bold text-slate-800 dark:text-slate-100 me-2">{{ $totalWarga }}
								</div>
								{{-- <div class="badge bg-yellow-500">-{{ $rejectedLaporan }}</div> --}}
							</div>
						</div>
					</div>
				</div>

				<!-- Kolom ketiga -->
				<div class="col-12 col-sm-4 col-xl-4 mb-4 d-flex flex-column">
					<div class="card h-100 shadow-sm border-gradient border-gradient-green">
						<div class="card-body">
							<header class="d-flex justify-content-between align-items-start mb-2">
								<!-- Icon -->
								<img alt="Icon" src="assets/media/icons/icon-03.svg" width="32"
									height="32" />
							</header>
							<h2 class="d-flex align-items-center text-dark mb-5">Jumlah RT</h2>
							<div class="text-muted text-uppercase mb-1">RT</div>
							<div class="d-flex align-items-start">
								<div class="fs-3 fw-bold text-slate-800 dark:text-slate-100 me-2">{{ $totalRT }}
								</div>
								{{-- <div class="badge bg-red-500">Fix</div> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end::Row-->
        </div>
    </div>
</div>

@endsection
