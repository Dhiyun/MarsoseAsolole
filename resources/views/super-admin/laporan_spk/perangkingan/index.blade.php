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
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Table-->
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
                                        <th class="min-w-125px">Total Score</th>
                                        <th class="min-w-125px">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @php
                                        $rank = 1;
                                    @endphp
                                    @foreach ($scores as $alternativeId => $score)
                                        @php
                                            $laporan = $laporans->firstWhere('id_alternatif', $alternativeId);
                                            $alternative = $alternatif->firstWhere('id_alternatif', $alternativeId);
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input value="{{ $laporan->id_alternatif }}" class="form-check-input" type="checkbox" />
                                                </div>
                                            </td>
                                            <td>{{ $laporan->id_alternatif }}</td>
                                            <td><a href="{{ route('laporan_spk.show', ['id' => $laporan->id_alternatif]) }}">{{ $alternative->laporanPengaduan->judul }}</a></td>
                                            @foreach($kriterias as $kriteria)
                                                @php
                                                    $nilaiField = "Kriteria{$kriteria->id_kriteria}";
                                                    $nilai = $laporan->$nilaiField;
                                                @endphp
                                                <td>{{ $nilai }}</td>
                                            @endforeach
                                            <td>{{ $score }}</td>
                                            <td>{{ $rank++ }}</td>
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

@section('scripts')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#kt_table_laporan_spk').DataTable();
        });
    </script>
@endsection
