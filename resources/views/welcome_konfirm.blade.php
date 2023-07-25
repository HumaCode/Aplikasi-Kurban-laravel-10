@extends('layouts.app_front')

{{-- @section('breadcumb')
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
@endsection --}}

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
                            <h5 class="card-title m-0">Selamat, Akun berhasil dibuat</h5>
                        </div>
                        <div class="card-body text-center">

                            <h3 class=" text-danger">Silahkan tunggu beberapa menit, untuk menunggu admin
                                mengkonfirmasi akun
                                anda</h3>
                            <p>Atau bisa hubungi tombol dibawah ini untuk mempercepat proses konfirmasi</p>

                            <form action="{{ route('tanya') }}" method="POST" target="_blank">
                                @csrf

                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">

                                <button class="btn btn-primary btn-lg" type="submit">KLIK DISINI</button>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
