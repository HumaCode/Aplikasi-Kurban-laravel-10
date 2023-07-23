@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ $subtitle }}</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        {!! Form::model($query, [
                            'route' => isset($query->id) ? ['infaq.update', $query->id] : 'infaq.store',
                            'method' => isset($query->id) ? 'PUT' : 'POST',
                        ]) !!}

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="">
                                    {!! Form::label('created_at', 'Tanggal Infaq', ['class' => 'form-label']) !!}
                                    {!! Form::date('created_at', $query->created_at ?? now(), ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first('created_at') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="">
                                    {!! Form::label('sumber_', 'Sumber Infaq', ['class' => 'form-label']) !!}
                                    {!! Form::select('sumber', $listSumber, null, ['class' => 'form-control', 'placeholder' => '-- Pilih --']) !!}
                                    <span class="text-danger">{{ $errors->first('sumber') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('jenis', 'Jenis', ['class' => 'form-label']) !!}
                            <div class="form-check">
                                {!! Form::radio('jenis', 'uang', 1, ['class' => 'form-check-input', 'id' => 'uang']) !!}
                                {!! Form::label('uang', 'Uang', ['class' => 'form-check-label']) !!}
                            </div>
                            <div class="form-check">
                                {!! Form::radio('jenis', 'barang', null, ['class' => 'form-check-input', 'id' => 'barang']) !!}
                                {!! Form::label('barang', 'Barang', ['class' => 'form-check-label']) !!}
                            </div>
                            <span class="text-danger">{{ $errors->first('jenis') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('atas_nama', 'Atas Nama - boleh dikosongkan', ['class' => 'form-label']) !!}
                            {!! Form::textarea('atas_nama', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Boleh dikosongkan',
                                'rows' => 3,
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('atas_nama') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('jumlah', 'Jumlah Infaq', ['class' => 'form-label']) !!}
                            {!! Form::text('jumlah', null, ['class' => 'form-control rupiah', 'placeholder' => 'Masukkan Jumlah']) !!}
                            <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('satuan', 'Satuan Jumlah - Misal: Kg, rupiah, atau sak untuk semen', ['class' => 'form-label']) !!}
                            {!! Form::text('satuan', $query->satuan ?? 'rupiah', [
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Satuan',
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('satuan') }}</span>
                        </div>

                        {!! Form::submit('SIMPAN DATA', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('infaq.index') }}" class='btn btn-danger'>Kembali</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
