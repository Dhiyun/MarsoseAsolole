@extends('super-admin.layouts.template')
@section('title', 'Super Admin | Level')

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
								<input type="text" data-kt-level-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Level" />
							</div>
							<!--end::Search-->
						</div>
						<!--begin::Card title-->
						<!--begin::Card toolbar-->
						<div class="card-toolbar">
							<!--begin::Toolbar-->
							<div class="d-flex justify-content-end" data-kt-level-table-toolbar="base">
								<!--begin::Add user-->
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_level">
								<i class="ki-outline ki-plus fs-2"></i>Tambah Level</button>
								<!--end::Add user-->
							</div>
							<!--end::Toolbar-->
							<!--begin::Group actions-->
							<div class="d-flex justify-content-end align-items-center d-none" data-kt-level-table-toolbar="selected">
								<div class="fw-bold me-5">
									<span class="me-2" data-kt-level-table-select="selected_count"></span>Selected
								</div>
								<form id="delete-selected-form" action="{{ route('level.deleteSelected') }}" method="POST">
									@csrf  <!-- Token CSRF untuk keamanan -->
									<input value="" type="hidden" name="selectedIds" id="selected-ids">  <!-- Input tersembunyi untuk ID yang dipilih -->
									<!-- Tombol untuk menghapus level yang dipilih -->
									<button type="submit" class="btn btn-danger" data-kt-level-table-select="delete_selected">Delete Selected</button>
								</form>
							</div>
							<!--end::Group actions-->
							@include('super-admin.level.create')
						</div>
						<!--end::Card toolbar-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_level">
							<thead>
								<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
									<th class="w-10px pe-2">
										<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
											<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_level .form-check-input" />
										</div>
									</th>
									<th class="min-w-125px">ID</th>
									<th class="min-w-125px">Kode Level</th>
									<th class="min-w-125px">Nama Level</th>
									<th class="text-end min-w-100px pe-9">Actions</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
								@foreach ($level as $lvl)
								<tr>
									<td>
										<div class="form-check form-check-sm form-check-custom form-check-solid">
											<input value="{{ $lvl->id_level }}" class="form-check-input" type="checkbox" data-kt-level-table-filter="checkbox" />
										</div>
									</td>
									<td>{{ $lvl->id_level }}</td>
									<td>{{ $lvl->level_kode }}</td>
									<td>{{ $lvl->level_nama }}</td>
									<td class="text-end">
										<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
											<i class="ki-outline ki-down fs-5 ms-1"></i>
										</a>
										<!-- Begin::Menu -->
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
											<!-- Begin::Menu item -->
											<div class="menu-item px-3">
												<a href="#"data-bs-toggle="modal" data-bs-target="#kt_modal_edit_level-{{ $lvl->id_level }}" class="menu-link px-3">Edit</a>
											</div>
											<!-- End::Menu item -->
											<!-- Begin::Menu item -->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3" data-kt-level-table-filter="delete_row" onclick="event.preventDefault(); handleRowDeletion(event);">
													Delete
												</a>
												<form id="delete-form-{{ $lvl->id_level }}" action="{{ url('/level/destroy/' . $lvl->id_level) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form>
											</div>
											<!-- End::Menu item -->
										</div>
										<!-- End::Menu -->
									</td>
									@include('super-admin.level.edit')
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
