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

                        <div class="form-group">
                            {!! Form::label('nama_bank', 'Nama Bank', ['class' => 'form-label']) !!}
                            {!! Form::select('bank_id', $listBank, null, [
                                'class' => 'form-control select2',
                                'placeholder' => '-- Pilih Bank --',
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('nama_rekening', 'Nama Pemilik Bank', ['class' => 'form-label']) !!}
                            {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('nomor_rekening', 'Nomor Rekening', ['class' => 'form-label']) !!}
                            {!! Form::text('nomor_rekening', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                        </div>

                        {!! Form::submit('SIMPAN DATA', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
