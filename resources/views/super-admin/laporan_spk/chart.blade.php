{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Laporan SPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Chart Laporan SPK Berdasarkan Skor</h1>
        <canvas id="laporanChart" width="400" height="200"></canvas>
        <a href="{{ route('laporan_spk.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Laporan</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('laporanChart').getContext('2d');
            const labels = {!! json_encode($labels) !!};
            const scores = {!! json_encode($scores) !!};

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Skor Prioritas Berdasarkan Peringkat (Desc)',
                    data: scores,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            new Chart(ctx, config);
        });
    </script>
</body>
</html> --}}

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
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <div class="container">
                                <h1 class="mt-5">Chart Laporan SPK Berdasarkan Skor</h1>
                                <canvas id="laporanChart" width="400" height="200"></canvas>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const ctx = document.getElementById('laporanChart').getContext('2d');
                                    const labels = {!! json_encode($labels) !!};
                                    const scores = {!! json_encode($scores) !!};

                                    const data = {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Skor Prioritas Berdasarkan Peringkat (Desc)',
                                            data: scores,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    };

                                    const config = {
                                        type: 'bar',
                                        data: data,
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    };
                                    new Chart(ctx, config);
                                });
                            </script>
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
