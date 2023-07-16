@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ strtoupper($subtitle) }}</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">


                        {!! Form::model($model, [
                            'route' => $route,
                            'method' => $method,
                        ]) !!}

                        <div class="mb-3">
                            {!! Form::label('nama', 'Kategori (misal: agenda kegiatan, informasi pengajian dan lainya.)', [
                                'class' => 'form-label',
                            ]) !!}
                            {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nama') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('keterangan', 'Keterangan', ['class' => 'form-label']) !!}
                            {!! Form::textarea('keterangan', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Keterangan',
                                'rows' => 5,
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                        </div>


                        {!! Form::submit('SIMPAN DATA', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
