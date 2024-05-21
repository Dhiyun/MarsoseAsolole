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
                    <!--begin::Nama Kepala Keluarga-->
                    <div class="card-header mt-5"><!--begin::Search-->
						<div class="d-flex align-items-center position-relative my-1">
							<!--begin::Menu- wrapper-->
							<div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px" onclick="window.history.back();">
								<i class="ki-outline ki-arrow-left fs-3"></i>
							</div>
							<!--begin::Menu-->
							<h1 class="mt-1">Kepala Keluarga : {{ $kk->kepala_keluarga }}</h1>
						</div>
						<!--end::Search-->
                    </div>
                    <!--end::Nama Kepala Keluarga-->
					<!--begin::Card header-->
					<div class="card-header border-0 pt-6">
						<!--begin::Card title-->
						<div class="card-title">
							<!--begin::Search-->
							<div class="d-flex align-items-center position-relative my-1">
								<i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
								<input type="text" data-kt-kk-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Nama" />
							</div>
							<!--end::Search-->
						</div>
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_kk">
							<thead>
								<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
									<th class="w-10px pe-2">
										<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
											<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_kk .form-check-input" />
										</div>
									</th>
									<th class="min-w-125px">ID</th>
									<th class="min-w-125px">NIK</th>
									<th class="min-w-125px">Nama</th>
                                    <th class="min-w-125px">TTL</th>
                                    <th class="min-w-125px">Alamat</th>
                                    <th class="min-w-125px">RT</th>
									<th class="min-w-125px">Status</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
								@foreach ($warga as $warga)
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input value="{{ $warga->id_warga }}" class="form-check-input" type="checkbox" data-kt-warga-table-filter="checkbox" />
										</div>
									</td>
                                    <td>{{ $warga->id_warga }}</td>
									<td>{{ $warga->nik }}</td>
									<td>{{ $warga->nama }}</td>
									<td>{{ $warga->tempat_lahir }}, {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d M Y') }}</td>
									<td>{{ $warga->alamat }}</td>
									<td>{{ $warga->kk->rt->no_rt ?? 'N/A' }}</td>
									<td>{{ $warga->user->level->level_nama }}</td>
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

@endsection
