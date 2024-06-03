@extends('super-admin.layouts.template')

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
							<!--begin::Group actions-->
							<div class="d-flex justify-content-end align-items-center d-none" data-kt-laporan-table-toolbar="selected">
								<div class="fw-bold me-5">
									<span class="me-2" data-kt-laporan-table-select="selected_count"></span>Selected
								</div>
								<form id="delete-selected-form" action="{{ route('laporan.deleteSelected') }}" method="POST">
									@csrf  <!-- Token CSRF untuk keamanan -->
									<input value="" type="hidden" name="selectedIds" id="selected-ids">  <!-- Input tersembunyi untuk ID yang dipilih -->
									<!-- Tombol untuk menghapus laporan yang dipilih -->
									<button type="submit" class="btn btn-danger" data-kt-laporan-table-select="delete_selected">Delete Selected</button>
								</form>
							</div>
							<!--end::Group actions-->
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
									<th class="w-10px pe-2">
										<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
											<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_laporan .form-check-input" />
										</div>
									</th>
									<th class="min-w-125px">ID</th>
									<th class="min-w-125px">Nama</th>
									<th class="min-w-125px">Tanggal Laporan</th>
									<th class="min-w-125px">Jenis Laporan</th>
                                    <th class="min-w-125px">Gambar</th>
                                    <th class="min-w-125px">Keterangan</th>
									<th class="min-w-125px">Status</th>
									<th class="text-end min-w-100px pe-9">Actions</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
								@foreach ($laporansP as $lp)
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input value="{{ $lp->id_laporan }}" class="form-check-input" type="checkbox" data-kt-laporan-table-filter="checkbox" />
										</div>
									</td>
									<td>{{ $lp->id_laporan }}</td>
									<td>{{ $lp->warga->nama }}</td>
									<td>{{ $lp->created_at->format('l, d F Y') }}</td>
									<td>{{ $lp->jenis_laporan }}</td>
									<td><img src="{{ asset($lp->gambar) }}" alt="Gambar Laporan" style="max-width: 125px; max-height: 125px;"></td>
									<td>{{ $lp->keterangan }}</td>
									<td>
										<button class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
											<span class="badge badge-{{ 
												($lp->status == 'diterima') ? 'light-success' : 
												(($lp->status == 'ditolak') ? 'light-danger' : 
												(($lp->status == 'diproses') ? 'light-warning' : 
												(($lp->status == 'selesai') ? 'light-primary' : 
												(($lp->status == 'menunggu') ? 'light-info' : ''))))
											}}">
												{{ ucfirst($lp->status) }}
											</span>
											<i class="ki-outline ki-down fs-5 ms-1"></i>
										</button>
										<!-- Begin::Menu -->
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-100px py-4" data-kt-menu="true">
											<!-- Begin::Menu item -->
											<div class="menu-item px-3">
												<input type="hidden" name="status" value="diterima">
												<button type="button" class="menu-link px-3 btn" data-bs-toggle="modal" data-bs-target="#kt_modal_add_laporan_accept-{{ $lp->id_laporan }}">
													<span class="badge badge-light-success">Diterima</span>
												</button>
											</div>
											<!-- End::Menu item -->
											<form action="{{ route('laporan.updateStatus') }}" method="POST" style="display:inline;">
												@csrf
												@method('PUT')
												<input type="hidden" name="id_laporan" value="{{ $lp->id_laporan }}">
												<!-- Begin::Menu item -->
												<div class="menu-item px-3">
													<input type="hidden" name="status" value="ditolak">
													<button type="submit" class="menu-link px-3 btn">
														<span class="badge badge-light-danger">Ditolak</span>
													</button>
												</div>
												<!-- End::Menu item -->
											</form>
										</div>
										<!-- End::Menu -->
									</td>
									<td class="text-end">
										<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
											<i class="ki-outline ki-down fs-5 ms-1"></i>
										</a>
										<!-- Begin::Menu -->
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
											<!-- Begin::Menu item -->
											<div class="menu-item px-3">
												<a href="{{ route('laporan.show', ['id' => $lp->id_laporan]) }}" class="menu-link px-3">Detail</a>
											</div>
											<!-- End::Menu item -->
											<!-- Begin::Menu item -->
											<div class="menu-item px-3">
												<a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_laporan-{{ $lp->id_laporan }}" class="menu-link px-3">Edit</a>
											</div>
											<!-- End::Menu item -->
											<!-- Begin::Menu item -->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3" data-kt-laporan-table-filter="delete_row" onclick="event.preventDefault(); handleRowDeletion(event);">
													Delete
												</a>
												<form id="delete-form-{{ $lp->id_laporan }}" action="{{ route('laporan.destroy', ['id' => $lp->id_laporan]) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form>
											</div>
											<!-- End::Menu item -->
										</div>
										<!-- End::Menu -->
									</td>
									@include('super-admin.laporan_pengaduan.acceptlaporan')
									@include('super-admin.laporan_pengaduan.edit')
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
