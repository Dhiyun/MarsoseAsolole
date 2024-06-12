@extends('super-admin.layouts.template')
@section('title', 'Super Admin | Laporan Pengaduan')

@section('content')

<div class="app-main flex-column flex-row-fluid mt-5 mx-5 mb-5" id="kt_app_main">
	<!--begin::Content wrapper-->
	<div class="d-flex flex-column flex-column-fluid">
		<!--begin::Toolbar-->
            @include('super-admin.layouts.breadcrumb')
		<!--end::Toolbar-->
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-fluid">
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card header-->
					<div class="card-header border-0 pt-6">
						<!--begin::Card title-->
						<div class="card-title">
							<!--begin::Search-->
							<div class="d-flex align-items-center position-relative my-1">
								<i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
								<input type="text" data-kt-laporan-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Laporan Pengaduan" />
							</div>
							<!--end::Search-->
						</div>
						<!--begin::Card title-->
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							<!--begin::Toolbar-->
							<div class="d-flex justify-content-end" data-kt-laporan-table-toolbar="base">
								<!--begin::Add Laporan Pengaduan-->
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_laporan">
								<i class="ki-outline ki-plus fs-2"></i>Tambah Laporan Pengaduan</button>
								<!--end::Add Laporan Pengaduan-->
							</div>
							<!--end::Toolbar-->
							@include('super-admin.laporan_pengaduan.create')
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_laporan">
							<thead>
								<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
									<th class="min-w-125px">Np</th>
									<th class="min-w-125px">Nama</th>
									<th class="min-w-125px">Judul</th>
									<th class="min-w-125px">Tanggal Laporan</th>
									<th class="min-w-125px">Jenis Laporan</th>
                                    <th class="min-w-125px">Gambar</th>
                                    <th class="min-w-125px">Keterangan</th>
									<th class="text-end min-w-100px pe-9">Status</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
								@php $no = 1 @endphp
								@foreach ($laporansP as $lp)
								<tr>
									<input id="id_laporan" type="hidden" value="{{ $lp->id_laporan }}" class="form-check-input" />
									<td>{{ $no++ }}</td>
									<td>{{ $lp->warga->nama }}</td>
									<td>{{ $lp->judul }}</td>
									<td>{{ $lp->created_at->format('l, d F Y') }}</td>
									<td>{{ $lp->jenis_laporan }}</td>
									<td><img src="{{ asset($lp->gambar) }}" alt="Gambar Laporan" style="max-width: 125px; max-height: 125px;"></td>
									<td>{{ $lp->keterangan }}</td>
									<td class="text-end">
										<button class="btn btn-light btn-light-{{ 
											($lp->status == 'diterima') ? 'success' : 
											(($lp->status == 'ditolak') ? 'danger' : 
											(($lp->status == 'diproses') ? 'warning' : 
											(($lp->status == 'selesai') ? 'primary' : 
											(($lp->status == 'menunggu') ? 'info' : ''))))
										}} btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
												{{ ucfirst($lp->status) }}
											<i class="ki-outline ki-down fs-5 ms-1"></i>
										</button>
										<!-- Begin::Menu -->
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
											@if($lp->status == 'diterima')
												<!-- Begin::Menu item -->
												<div class="menu-item px-3">
													<input type="hidden" name="status" value="diproses">
													<button type="button" class="btn btn-sm btn-warning w-100px" data-bs-toggle="modal" data-bs-target="#kt_modal_add_laporan-accept-{{ $lp->id_laporan }}">
															<i class="fas fa-cogs fa-sm"></i>Proses
													</button>
												</div>
												<!-- End::Menu item -->
											@endif
											@if($lp->status == 'menunggu')
												<form action="{{ route('laporan.updateStatus') }}" method="POST" style="display:inline;">
													@csrf
													@method('PUT')
													<input type="hidden" name="id_laporan" value="{{ $lp->id_laporan }}">
													<!-- Begin::Menu item -->
													<div class="menu-item px-3">
														<input type="hidden" name="status" value="diterima">
														<button type="submit" class="btn btn-sm btn-success w-100px">
															<i class="fas fa-check fa-sm"></i>Terima
														</button>
													</div>
													<!-- End::Menu item -->
												</form>
												<!-- End::Menu item -->
												<form action="{{ route('laporan.updateStatus') }}" method="POST" style="display:inline;">
													@csrf
													@method('PUT')
													<input type="hidden" name="id_laporan" value="{{ $lp->id_laporan }}">
													<!-- Begin::Menu item -->
													<div class="menu-item px-3">
														<input type="hidden" name="status" value="ditolak">
														<button type="submit" class="btn btn-sm btn-danger w-100px">
															<i class="fas fa-times fa-sm"></i>Tolak
														</button>
													</div>
													<!-- End::Menu item -->
												</form>
											@endif
										</div>
										<!-- End::Menu -->
									</td>
									@include('super-admin.laporan_pengaduan.acceptlaporan')
								</tr>
								@endforeach
							</tbody>
						</table>
						<!--end::Table-->
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
        @include('super-admin.layouts.footer')
    <!--end::Footer-->
</div>

<script>
	window.cekNIKRoute = "{{ route('cek_nik') }}";
    window.cekKKRoute = "{{ route('cek_kk') }}";
</script>

@endsection
