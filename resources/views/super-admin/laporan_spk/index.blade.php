@extends('super-admin.layouts.template')
@section('title', 'Super Admin | Daftar Laporan SPK')

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
                                    <input type="text" data-kt-laporan_spk-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="Search Laporan SPK" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-laporan_spk-table-toolbar="base">
                                    <!--begin::Add Laporan SPK-->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_laporan_spk">
                                        <i class="ki-outline ki-plus fs-2"></i>Tambah Laporan SPK</button>
                                    <!--end::Add Laporan SPK-->
                                </div>
                                <!--begin::Lihat Prioritas-->
                                <a href="{{ route('laporan_spk.priority') }}" class="btn btn-danger me-2"
                                    style="margin-left: 5px">
                                    <i class="ki-outline ki-eye fs-2"></i>Lihat Prioritas
                                </a>
                                <!--end::Lihat Prioritas-->

                                <!--begin::Chart Prioritas-->
                                <a href="{{ route('laporan_spk.chart') }}" class="btn btn-success">
                                    <i class="ki-outline ki-chart fs-2"></i>Chart Prioritas
                                </a>
                                <!--end::Chart Prioritas-->
                                <!--end::Toolbar-->
                                <!--begin::Group actions-->
                                <div class="d-flex justify-content-end align-items-center d-none"
                                    data-kt-laporan_spk-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2"
                                            data-kt-laporan_spk-table-select="selected_count"></span>Selected
                                    </div>
                                    <form id="delete-selected-form" action="{{ route('laporan_spk.deleteSelected') }}"
                                        method="POST">
                                        @csrf <!-- Token CSRF untuk keamanan -->
                                        <input value="" type="hidden" name="selectedIds" id="selected-ids">
                                        <!-- Input tersembunyi untuk ID yang dipilih -->
                                        <!-- Tombol untuk menghapus warga yang dipilih -->
                                        <button type="submit" class="btn btn-danger"
                                            data-kt-laporan_spk-table-select="delete_selected">Delete Selected</button>
                                    </form>
                                </div>
                                <!--end::Group actions-->
                                @include('super-admin.laporan_spk.create')
                                {{-- @include('super-admin.laporan_spk.chart') --}}
                                {{-- @include('super-admin.laporan_spk.priority') --}}
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_laporan_spk">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_laporan_spk .form-check-input" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">ID</th>
                                        <th class="min-w-125px">Jenis Laporan</th>
                                        <th class="min-w-125px">Biaya</th>
                                        <th class="min-w-125px">Dampak</th>
                                        <th class="min-w-125px">Durasi Pekerjaan</th>
                                        <th class="min-w-125px">SDM</th>
                                        <th class="text-end min-w-100px pe-9">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($laporans as $laporan)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input value="{{ $laporan->id_spk }}" class="form-check-input"
                                                        type="checkbox" data-kt-laporan_spk-table-filter="checkbox" />
                                                </div>
                                            </td>
                                            <td>{{ $laporan->id_spk }}</td>
                                            <td>{{ $laporan->jenis_laporan }}</td>
                                            <td>{{ $laporan->biaya }}</td>
                                            <td>{{ $laporan->getSdmDescription() }}</td>
                                            <td>{{ $laporan->durasi_pekerjaan }} hari</td>
                                            <td>{{ $laporan->sdm }} orang</td>
                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-outline ki-down fs-5 ms-1"></i>
                                                </a>
                                                <!-- Begin::Menu -->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">    
                                                    <!-- Begin::Menu item -->
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_edit_laporan_spk-{{ $laporan->id_spk }}"
                                                            class="menu-link px-3"><i class="ki-outline ki-pencil fs-6"></i>- Edit</a>
                                                    </div>
                                                    <!-- End::Menu item -->
                                                    <!-- Begin::Menu item -->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3"
                                                            data-kt-laporan_spk-table-filter="delete_row"
                                                            onclick="event.preventDefault(); handleRowDeletion(event);"><i class="ki-outline ki-trash fs-6"></i>
                                                            - Delete
                                                        </a>
                                                        <form id="delete-form-{{ $laporan->id_spk }}"
                                                            action="{{ route('laporan_spk.destroy', ['id' => $laporan->id_spk]) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                    <!-- End::Menu item -->
                                                </div>
                                                <!-- End::Menu -->
                                            </td>
                                            @include('super-admin.laporan_spk.edit')
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
