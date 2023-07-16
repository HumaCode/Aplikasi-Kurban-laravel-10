@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">EDIT PROFIL</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h5 class="card-title mb-0">Silahkan isi data masjid yang anda kelola</h5> --}}
                    </div>
                    <div class="card-body">

                        {!! Form::model(auth()->user(), [
                            'method' => 'PUT',
                            'route' => ['userprofil.update', 0],
                        ]) !!}

                        <div class="form-group mb-3">
                            <label for="name" class="mb-2">Nama</label>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{!! $errors->first('name') !!}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="mb-2">Email</label>
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{!! $errors->first('email') !!}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="mb-2">Password</label>
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            <span class="text-danger">{!! $errors->first('password') !!}</span>
                        </div>

                        <div class="form-group mb-3">
                            {!! Form::submit('UBAH PROFIL', ['class' => 'btn btn-primary btn-sm']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
