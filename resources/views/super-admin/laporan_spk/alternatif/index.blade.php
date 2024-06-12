@extends('super-admin.layouts.template')
@section('title', 'Super Admin | Alternatif')

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
                                    <input type="text" data-kt-alternatif-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="Search Alternatif" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-alternatif-table-toolbar="base">
                                    <!--begin::Add Alternatif Pengaduan-->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_alternatif">
                                        <i class="ki-outline ki-plus fs-2"></i>Tambah Alternatif</button>
                                    <!--end::Add Alternatif Pengaduan-->
                                </div>
                                <!--end::Toolbar-->
                                <!--begin::Group actions-->
                                <div class="d-flex justify-content-end align-items-center d-none"
                                    data-kt-alternatif-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2"
                                            data-kt-alternatif-table-select="selected_count"></span>Selected
                                    </div>
                                    <form id="delete-selected-form" action="{{ route('alternatif.deleteSelected') }}"
                                        method="POST">
                                        @csrf <!-- Token CSRF untuk keamanan -->
                                        <input value="" type="hidden" name="selectedIds" id="selected-ids">
                                        <!-- Input tersembunyi untuk ID yang dipilih -->
                                        <!-- Tombol untuk menghapus alternatif yang dipilih -->
                                        <button type="submit" class="btn btn-danger"
                                            data-kt-alternatif-table-select="delete_selected">Delete Selected</button>
                                    </form>
                                </div>
                                <!--end::Group actions-->
                                @include('super-admin.laporan_spk.alternatif.create')
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_alternatif">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_alternatif .form-check-input" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">ID</th>
                                        <th class="min-w-125px">Nama</th>
                                        <th class="min-w-125px">Jenis Laporan</th>
                                        <th class="text-end min-w-100px pe-9">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($alternatifs as $alternatif)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input value="{{ $alternatif->id_alternatif }}" class="form-check-input"
                                                        type="checkbox" data-kt-alternatif-table-filter="checkbox" />
                                                </div>
                                            </td>
                                            <td>{{ $alternatif->id_alternatif }}</td>
                                            <td>{{ $alternatif->laporanPengaduan->warga->nama }}</td>
                                            <td>{{ $alternatif->laporanPengaduan->judul }}</td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-outline ki-down fs-5 ms-1"></i>
                                                </a>
                                                <!-- Begin::Menu -->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <!-- Begin::Menu item -->
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_edit_alternatif-{{ $alternatif->id_alternatif }}"
                                                            class="menu-link px-3"><i
                                                                class="ki-outline ki-pencil fs-6"></i>-Edit</a>
                                                    </div>
                                                    <!-- End::Menu item -->
                                                    <!-- Begin::Menu item -->
                                                    <div class="menu-item px-3">
                                                        <form id="deleteForm_{{ $alternatif->id_alternatif }}"
                                                            action="{{ route('alternatif.destroy', ['id' => $alternatif->id_alternatif]) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a href="#" class="menu-link px-3"
                                                            onclick="event.preventDefault(); document.getElementById('deleteForm_{{ $alternatif->id_alternatif }}').submit();">
                                                            <i class="ki-outline ki-trash fs-6"></i> - Delete
                                                        </a>
                                                        {{-- <a href="#" class="menu-link px-3" data-kt-alternatif-table-filter="delete_row" onclick="event.preventDefault(); handleRowDeletion(event);">
													Delete
												</a>
												<form id="delete-form-{{ $alternatif->id_alternatif }}" action="{{ route('alternatif.destroy', ['id' => $alternatif->id_alternatif]) }}" method="POST" style="display: none;">
													@csrf
													@method('DELETE')
												</form> --}}
                                                    </div>
                                                    <!-- End::Menu item -->
                                                </div>
                                                <!-- End::Menu -->
                                            </td>
                                            @include('super-admin.laporan_spk.alternatif.edit')
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
        window.cekKKRoute = "{{ route('cek_kk') }}";
    </script>

@endsection
