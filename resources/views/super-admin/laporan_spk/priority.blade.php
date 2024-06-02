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
                                <a href="{{ route('laporan_spk.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar
                                    Laporan</a>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Toolbar-->
                                <!--begin::Chart Prioritas-->
                                <a href="{{ route('laporan_spk.chart') }}" class="btn btn-success">
                                    <i class="ki-outline ki-chart fs-2"></i>Chart Prioritas
                                </a>
                                <!--end::Chart Prioritas-->
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
                                        <th class="min-w-125px">ID</th>
                                        <th class="min-w-125px">Jenis Laporan</th>
                                        <th class="min-w-125px">Biaya</th>
                                        <th class="min-w-125px">Dampak</th>
                                        <th class="min-w-125px">Durasi Pekerjaan</th>
                                        <th class="min-w-125px">SDM</th>
                                        <th class="min-w-125px">Total Score</th>
                                        <th class="min-w-125px">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($laporans as $laporan)
                                        <tr>
                                            <td>{{ $laporan->id_spk }}</td>
                                            <td>{{ $laporan->jenis_laporan }}</td>
                                            <td>{{ $laporan->biaya }}</td>
                                            <td>{{ $laporan->getSdmDescription() }}</td>
                                            <td>{{ $laporan->durasi_pekerjaan }} hari</td>
                                            <td>{{ $laporan->sdm }} orang</td>
                                            <td>{{ $laporan->total_score }}</td>
                                            <td>{{ $i++ }}</td>
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
