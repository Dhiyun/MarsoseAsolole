@extends('super-admin.layouts.template')
@section('title', 'Super Admin | Grafik Perangkingan')

@section('content')
    <div class="app-main flex-column flex-row-fluid mt-5 mx-5 mb-5" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            @include('super-admin.layouts.breadcrumb')
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    @if ($peringkat->isEmpty())
                        <div class="card">
                            <div class="card-body text-center py-15">
                                <h3 class="fw-bold text-dark mb-3">Belum ada laporan yang dinilai</h3>
                                <p class="text-muted fs-6 mb-8">
                                    Grafik akan muncul setelah laporan diberi nilai untuk setiap kriteria.
                                </p>
                                <a href="{{ route('laporan_spk.index') }}" class="btn btn-primary">Buka Daftar Laporan SPK</a>
                            </div>
                        </div>
                    @else
                        <div class="card mb-6">
                            <div class="card-header border-0 pt-6">
                                <div class="card-title flex-column">
                                    <h3 class="fw-bold text-dark mb-1">Skor Prioritas Laporan</h3>
                                    <span class="text-muted fs-7">
                                        Makin panjang batangnya, makin tinggi prioritasnya untuk dikerjakan lebih dulu.
                                    </span>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="grafik_perangkingan"></div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body py-4">
                                <table class="table align-middle table-row-dashed fs-6 gy-4">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-100px">Peringkat</th>
                                            <th class="w-125px">Kode</th>
                                            <th>Judul Laporan</th>
                                            <th class="text-end w-125px">Skor</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700 fw-semibold">
                                        @foreach ($peringkat as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item['kode'] }}</td>
                                                <td>{{ $item['judul'] }}</td>
                                                <td class="text-end">{{ number_format($item['skor'], 4) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($peringkat->isNotEmpty())
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var peringkat = @json($peringkat);

                new ApexCharts(document.querySelector('#grafik_perangkingan'), {
                    chart: { type: 'bar', height: Math.max(300, peringkat.length * 48), toolbar: { show: false } },
                    series: [{ name: 'Skor', data: peringkat.map(function (item) { return item.skor; }) }],
                    xaxis: {
                        categories: peringkat.map(function (item) { return item.kode + ' - ' + item.judul; }),
                        labels: { formatter: function (nilai) { return Number(nilai).toFixed(2); } }
                    },
                    yaxis: { labels: { maxWidth: 320 } },
                    plotOptions: { bar: { horizontal: true, borderRadius: 4, barHeight: '60%' } },
                    colors: ['#EA5403'],
                    dataLabels: {
                        enabled: true,
                        formatter: function (nilai) { return Number(nilai).toFixed(4); },
                        style: { colors: ['#fff'] }
                    },
                    tooltip: { y: { formatter: function (nilai) { return Number(nilai).toFixed(4); } } }
                }).render();
            });
        </script>
    @endpush
@endif
