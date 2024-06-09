@extends('super-admin.layouts.template')
@section('title', 'Super Admin | Daftar Laporan SPK')

@section('content')
    <div class="app-main flex-column flex-row-fluid mt-5 mx-5 mb-5" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            @include('super-admin.layouts.breadcrumb')
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                    <input type="text" data-kt-laporan_spk-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="Search Laporan SPK" />
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-laporan_spk-table-toolbar="base">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_laporan_spk">
                                        <i class="ki-outline ki-plus fs-2"></i>Tambah Laporan SPK</button>
                                </div>
                                <div class="d-flex justify-content-end align-items-center d-none"
                                    data-kt-laporan_spk-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-laporan_spk-table-select="selected_count"></span>Selected
                                    </div>
                                    <form id="delete-selected-form" action="{{ route('laporan_spk.deleteSelected') }}" method="POST">
                                        @csrf
                                        <input value="" type="hidden" name="selectedIds" id="selected-ids">
                                        <button type="submit" class="btn btn-danger" data-kt-laporan_spk-table-select="delete_selected">Delete Selected</button>
                                    </form>
                                </div>
                                @include('super-admin.laporan_spk.create')
                            </div>
                        </div>
                        <div class="card-body py-4">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_laporan_spk">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_laporan_spk .form-check-input" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">ID</th>
                                        <th class="min-w-125px">Judul</th>
                                        @foreach($kriterias as $kriteria)
                                            <th class="min-w-125px">{{ $kriteria->nama_kriteria }}</th>
                                        @endforeach
                                        <th class="text-end min-w-100px pe-9">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($laporans as $laporan)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input value="{{ $laporan->id_alternatif }}" class="form-check-input" type="checkbox" />
                                                </div>
                                            </td>
                                            <td>{{ $laporan->id_alternatif }}</td>
                                            <td>@if($laporan->alternatif && $laporan->alternatif->laporanPengaduan && $laporan->alternatif->laporanPengaduan->judul)
                                                {{ $laporan->alternatif->laporanPengaduan->judul }}
                                            @else
                                                N/A
                                            @endif</td>
                                            @foreach($kriterias as $kriteria)
                                                <td>{{ $laporan->{'Kriteria' . ($loop->index + 1)} ?? 0 }}</td>
                                            @endforeach
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-outline ki-down fs-5 ms-1"></i>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_laporan_spk-{{ $laporan->id_alternatif }}" class="menu-link px-3"><i class="ki-outline ki-pencil fs-6"></i>- Edit</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-laporan_spk-table-filter="delete_row" onclick="event.preventDefault(); handleRowDeletion(event);">
                                                            <i class="ki-outline ki-trash fs-6"></i> - Delete
                                                        </a>
                                                        <form id="delete-form-{{ $laporan->id_alternatif }}" action="{{ route('warga.destroy', ['id' => $laporan->id_alternatif]) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                    <!-- End::Menu item -->
                                                </div>
                                            </td>
                                        </tr>
                                        @include('super-admin.laporan_spk.edit')
                                    @endforeach
                                </tbody>                                                                           
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('super-admin.layouts.footer')
    </div>
@endsection
