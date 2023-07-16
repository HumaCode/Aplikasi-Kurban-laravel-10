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
                                    {!! Form::label('kategori', 'Kategori', ['class' => 'form-label']) !!}
                                    {!! Form::select('kategori', $listKategori, null, [
                                        'class' => 'form-control',
                                        'placeholder' => '-- Pilih --',
                                    ]) !!}
                                    <span class="text-danger">{{ $errors->first('kategori') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('judul', 'Judul', ['class' => 'form-label']) !!}
                                    {!! Form::text('judul', null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first('judul') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('konten', 'Konten / Isi Profil', ['class' => 'form-label']) !!}
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
