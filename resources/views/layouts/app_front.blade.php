<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Beranda</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">

    <style>
        .hd {
            border-radius: 85px;
            border: 1px solid lightseagreen;
        }

        .hder {
            border-bottom: none;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark bg-info">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="{{ asset('images') }}/masjid.png" alt="{{ config('app.name') }}"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('welcome') }}" class="nav-link">Beranda</a>
                        </li>

                        @isset($masjid)
                            @if ($masjid->profils->count() > 0)
                                <li class="nav-item dropdown">
                                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" class="nav-link dropdown-toggle">Profil</a>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                        @forelse ($masjid->profils as $itemProfil)
                                            <li>
                                                <a href="{{ route('data_masjid.profil', [$masjid->slug, $itemProfil->slug]) }}"
                                                    class="dropdown-item">{{ $itemProfil->judul }}</a>
                                            </li>
                                        @empty
                                            <li>
                                                <span class="dropdown-item text-danger"><strong>Belum Ada
                                                        Data</strong></span>
                                            </li>
                                        @endforelse
                                    </ul>
                                </li>

                                {{-- @foreach ($masjid->kategori as $item)
                                <li class="nav-item dropdown">
                                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" class="nav-link dropdown-toggle">{{ $item->nama }}</a>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                        @foreach ($item->informasi as $itemInformasi)
                                            <li><a href="#" class="dropdown-item">{{ $itemInformasi->judul }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach --}}

                                <li class="nav-item dropdown">

                                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" class="nav-link dropdown-toggle">Kegiatan Masjid</a>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                                        <!-- Level two dropdown-->
                                        @foreach ($masjid->kategori as $item)
                                            <li class="dropdown-submenu dropdown-hover">
                                                <a id="{{ $item->id }}" href="#" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    class="dropdown-item dropdown-toggle">{{ $item->nama }}</a>
                                                <ul aria-labelledby="{{ $item->id }}"
                                                    class="dropdown-menu border-0 shadow">
                                                    @forelse ($item->informasi as $itemInformasi)
                                                        <li>
                                                            <a tabindex="-1"
                                                                href="{{ route('data_masjid.informasi', [$masjid->slug, $itemInformasi->slug]) }}"
                                                                class="dropdown-item">{{ $itemInformasi->judul }}</a>
                                                        </li>
                                                    @empty
                                                        <li>
                                                            <span tabindex="-1" href="#"
                                                                class="dropdown-item text-danger"><strong>Belum Ada
                                                                    Data</strong></span>
                                                        </li>
                                                    @endforelse
                                                </ul>

                                            </li>
                                        @endforeach
                                        <!-- End Level two -->
                                    </ul>
                                </li>
                            @endif

                        @endisset

                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login Pengurus</a>
                        </li>

                    </ul>


                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Beranda </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('welcome') }}">{{ config('app.name') }}</a></li>
                                <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('adminlte') }}/dist/js/demo.js"></script> --}}
</body>

</html>
