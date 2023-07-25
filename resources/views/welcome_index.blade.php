@extends('layouts.app_front')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card hd">
                        <div class="card-header hder">
                            <h5 class="card-title m-0">
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <img src="{{ asset('images') }}/logo2.gif" width="70%"
                                            alt="{{ config('app.name') }}" class="brand-image img-circle "
                                            style="opacity: .8">
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <p class="mt-3">{{ config('app.name') }}</p>
                                        <small class="">Aplikasi Administrasi Keuangan Masjid</small>
                                    </div>
                                </div>
                            </h5>
                        </div>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Masjid Terdaftar</h5>
                        </div>
                        <div class="card-body">

                            {{-- <div class="d-flex text-muted pt-3">
                            <img class="bd-placeholder-img flex-shrink-0"
                                src="{{ asset('images') }}/logo2.gif" alt="...">

                            <p class="">asldalsdlasldk</p>
                        </div> --}}

                            @foreach ($masjid as $item)
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-1 text-center">
                                            <img src="{{ asset('images') }}/logo2.gif" alt="..." width="100">
                                        </div>
                                        <div class="col-md-11">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong>Masjid
                                                        {{ ucwords($item->nama) }}</strong></h5>
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
