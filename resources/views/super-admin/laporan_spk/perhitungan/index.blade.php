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
                            <h2>Perhitungan SPK</h2>

                            <!-- Toggle for Tahap 1: Nilai Awal -->
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Tahap 1: Nilai Awal
                                        </button>
                                    </h1>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Alternatif</th>
                                                        @foreach ($kriterias as $kriteria)
                                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($calculations as $calculation)
                                                    <tr>
                                                        <td>{{ $calculation['id_alternatif'] }}</td>
                                                        @foreach ($calculation['kriteria'] as $kriteriaCalculation)
                                                            <td>
                                                                {{ $kriteriaCalculation['nilai_awal'] }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Toggle for Tahap 2: Menghitung Bobot ROC -->
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Tahap 2: Menghitung Bobot ROC
                                        </button>
                                    </h1>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($weights as $index => $weight)
                                                    <li>Bobot Kriteria {{ $index + 1 }}: {{ $weight }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Toggle for Tahap 3: Konfigurasi Nilai Utility -->
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Tahap 3: Konfigurasi Nilai Utility
                                        </button>
                                    </h1>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Alternatif</th>
                                                        @foreach ($kriterias as $kriteria)
                                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($calculations as $calculation)
                                                    <tr>
                                                        <td>{{ $calculation['id_alternatif'] }}</td>
                                                        @foreach ($calculation['kriteria'] as $kriteriaCalculation)
                                                            <td>
                                                                {{ $kriteriaCalculation['nilai_normalisasi'] }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Toggle for Tahap 4: Nilai Tertimbang -->
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Tahap 4: Nilai Tertimbang
                                        </button>
                                    </h1>
                                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Alternatif</th>
                                                        @foreach ($kriterias as $kriteria)
                                                            <th>{{ $kriteria->nama_kriteria }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($calculations as $calculation)
                                                    <tr>
                                                        <td>{{ $calculation['id_alternatif'] }}</td>
                                                        @foreach ($calculation['kriteria'] as $kriteriaCalculation)
                                                            <td>
                                                                {{ $kriteriaCalculation['nilai_terbobot'] }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Toggle for Tahap 5: Menghitung Skor -->
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            Tahap 5: Menghitung Skor
                                        </button>
                                    </h1>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>ID Alternatif</th>
                                                        <th>Total Skor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($scores as $alternativeId => $score)
                                                        <tr>
                                                            <td>{{ $alternativeId }}</td>
                                                            <td>{{ $score }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Toggle for Tahap 6: Perangkingan -->
                                <div class="accordion-item">
                                    <h1 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Tahap 6: Perangkingan
                                        </button>
                                    </h1>
                                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <table class="table table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Ranking</th>
                                                        <th>ID Alternatif</th>
                                                        <th>Total Skor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $ranking = 1; @endphp
                                                    @foreach ($sortedScores as $alternativeId => $score)
                                                        <tr>
                                                            <td>{{ $ranking++ }}</td>
                                                            <td>{{ $alternativeId }}</td>
                                                            <td>{{ $score }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
            $('.datatable').DataTable();
        });
    </script>
@endsection
