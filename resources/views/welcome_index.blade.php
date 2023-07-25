@extends('layouts.app_front')

@section('breadcumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Beranda </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">Beranda</li>
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
                                    <h3 class="mt-3"> <strong>{{ config('app.name') }}</strong></h3>
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
                            <h5 class="card-title m-0">MASJID TERDAFTAR</h5>
                        </div>
                        <div class="card-body">

                            @foreach ($masjids as $item)
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-1 text-center">
                                            <img src="{{ asset('images') }}/logo2.gif" alt="..." width="100">
                                        </div>
                                        <div class="col-md-11">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('data_masjid.show', $item->slug) }}">
                                                        <strong>Masjid
                                                            {{ ucwords($item->nama) }}</strong>
                                                    </a>
                                                </h5>
                                                <p class="card-text">{{ $item->alamat }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


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
