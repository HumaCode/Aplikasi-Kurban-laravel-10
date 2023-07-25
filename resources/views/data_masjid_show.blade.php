@extends('layouts.app_front')

@section('breadcumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> DETAIL MASJID </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card hd">
                        <div class="card-header hder">
                            <div class="row">
                                <div class="col-lg-4 text-center">
                                    <img src="{{ asset('images') }}/logo2.gif" width="30%" alt="{{ config('app.name') }}"
                                        class="brand-image img-circle " style="opacity: .8">
                                </div>
                                <div class="col-lg-4 text-center ">
                                    <h3 class="mt-3"><strong>Masjid {{ ucwords($masjid->nama) }}</strong></h3>
                                    <p class="">Aplikasi Administrasi Keuangan Masjid</p>
                                </div>
                                <div class="col-lg-4  text-center">
                                    <img src="{{ asset('images') }}/logo2.gif" width="30%" alt="{{ config('app.name') }}"
                                        class="brand-image img-circle " style="opacity: .8">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">DETAIL MASJID</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="{{ config('app.table-style') }}">
                                    <thead class="text-center {{ config('app.thead-style') }}">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Jenis</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse ($kas as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}.</td>
                                                <td>{{ $item->tanggal->translatedFormat('d F Y') }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td class="text-center">
                                                    @if ($item->jenis == 'masuk')
                                                        <span
                                                            class="badge badge-pill badge-success">{{ ucwords($item->jenis) }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-secondary">{{ ucwords($item->jenis) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ formatRupiah($item->jumlah, true) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-danger"><strong>Belum ada
                                                        data</strong></td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                                <h4><strong>Saldo Akhir : {{ formatRupiah($masjid->saldo_akhir, true) }}</strong></h4>
                            </div>

                        </div>
                        <div class="card-footer ">
                            <a href="{{ route('login') }}" class="float-right">Login sebagai pengurus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
