@extends('layouts.app_adminkit')

@push('js')
    {{-- larapex --}}
    {{-- <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }} --}}

    {{-- apexchart --}}
    <script src="{{ asset('achart') }}/dist/apexcharts.min.js"></script>

    <link href="{{ asset('achart') }}/dist/apexcharts.css" rel="stylesheet">


    <script>
        var options = {
            series: [{
                name: "Total Infaq",
                data: @json($dataTotalInfaq)
            }],
            chart: {
                height: 285,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Data Infaq Bulanan',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($dataBulan),
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString("id-ID", {
                            style: "currency",
                            currency: "IDR",
                        })
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush

@section('content')
    <div class="container-fluid p-0">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">{{ strtoupper($title) }}</h1>

            <div class="row">
                <div class="col-xl-5 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Saldo Akhir</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="truck"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ formatRupiah($saldoAkhir, true) }}</h1>
                                        <div class="mb-0">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                            </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Total Infaq Hari ini</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ formatRupiah($totalInfaq, true) }}</h1>
                                        <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                            </span>
                                            <span class="text-muted">Since last week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 col-xxl-7">
                    <div class="card flex-fill w-100">

                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                {{-- {!! $chart->container() !!} --}}

                                <div id="chart"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Transaksi Kas Terbaru</h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th class="d-none d-xl-table-cell">Tanggal Transaksi</th>
                                    <th>Jenis</th>
                                    <th class="d-none d-md-table-cell">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($kas as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td class="d-none d-xl-table-cell text-center">{{ $item->tanggal->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            @if ($item->jenis == 'masuk')
                                                <span class="badge bg-success">{{ $item->jenis }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger">{{ $item->jenis }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="d-none d-md-table-cell text-end">{{ formatRupiah($item->jumlah, true) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger"><strong>Tidak ada data
                                            </strong></td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Monthly Sales</h5>
                        </div>
                        <div class="card-body d-flex w-100">
                            <div class="align-self-center chart chart-lg">
                                <div id="chart2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
