@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">DATA MASJID</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Silahkan isi data masjid yang anda kelola</h5>
                    </div>
                    <div class="card-body">

                        {!! Form::model($masjid, [
                            'method' => 'POST',
                            'route' => 'masjid.store',
                        ]) !!}

                        <div class="form-group mb-3">
                            <label for="nama" class="mb-2">Nama Masjid</label>
                            {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{!! $errors->first('nama') !!}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="mb-2">Alamat Masjid</label>
                            {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{!! $errors->first('alamat') !!}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="telp" class="mb-2">No. Hp Pengurus</label>
                            {!! Form::text('telp', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{!! $errors->first('telp') !!}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="mb-2">Email</label>
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{!! $errors->first('email') !!}</span>
                        </div>

                        <div class="form-group mb-3">
                            {!! Form::submit('SIMPAN DATA', ['class' => 'btn btn-primary btn-sm']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
