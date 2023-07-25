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
                                        <p class="mt-3"><strong>Masjid {{ ucwords($masjid->nama) }}</strong></p>
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
                            <h5 class="card-title m-0">DETAIL MASJID</h5>
                        </div>
                        <div class="card-body">




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
