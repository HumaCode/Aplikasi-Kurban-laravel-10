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

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('tahun_hijriah', 'Tahun Hijriah', ['class' => 'form-label']) !!}
                                    {!! Form::selectRange('tahun_hijriah', 1445, 1460, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => '-- Pilih --',
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('tahun_hijriah') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('tahun_masehi', 'Tahun Masehi', ['class' => 'form-label']) !!}
                                    {!! Form::selectRange('tahun_masehi', 2023, date('Y'), null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => '-- Pilih --',
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('tahun_masehi') }}</span>
                                </div>
                            </div>

                        </div>

                        <div>
                            {!! Form::label('tanggal_akhir_pendaftaran', 'Tanggal Akhir Pendaftaran', ['class' => 'form-label']) !!}
                            {!! Form::date('tanggal_akhir_pendaftaran', now(), ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal_akhir_pendaftaran') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('konten', 'Informasi Kurban', ['class' => 'form-label']) !!}
                            {!! Form::textarea('konten', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Konten',
                                'id' => 'summernote',
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('konten') }}</span>
                        </div>


                        {!! Form::submit('SIMPAN DATA', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
