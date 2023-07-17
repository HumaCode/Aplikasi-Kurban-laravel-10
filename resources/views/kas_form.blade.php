@extends('layouts.app_adminkit')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">{{ $subtitle }}</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

                    <div class="alert alert-primary">
                        <strong class="fs-3">Saldo akhir saat ini adalah :
                            {{ formatRupiah($saldoAkhir, true) }}</strong>
                    </div>

                    {!! Form::model($kas, [
                    'route' => isset($kas->id) ? ['kas.update', $kas->id] : 'kas.store',
                    'method' => isset($kas->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <div class="mb-3">
                        {!! Form::label('tanggal', 'Tanggal', ['class' => 'form-label']) !!}
                        {!! Form::date('tanggal', $kas->tanggal ?? now(), ['class' => 'form-control', $disable]) !!}
                        <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                    </div>

                    <div class="mb-3">
                        {!! Form::label('keterangan', 'Keterangan', ['class' => 'form-label']) !!}
                        {!! Form::textarea('keterangan', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Keterangan',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div>
                                {!! Form::label('jenis', 'Jenis', ['class' => 'form-label']) !!}
                                <div class="form-check">
                                    {!! Form::radio('jenis', 'masuk', 1, ['class' => 'form-check-input', 'id' =>
                                    'jenis_masuk', $disable]) !!}
                                    {!! Form::label('jenis_masuk', 'Pemasukan', ['class' => 'form-check-label']) !!}
                                </div>
                                <div class="form-check">
                                    {!! Form::radio('jenis', 'keluar', null, ['class' => 'form-check-input', 'id' =>
                                    'jenis_keluar', $disable]) !!}
                                    {!! Form::label('jenis_keluar', 'Pengeluaran', ['class' => 'form-check-label']) !!}
                                </div>
                                <span class="text-danger">{{ $errors->first('jenis') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                {!! Form::label('jumlah', 'Jumlah', ['class' => 'form-label']) !!}
                                {!! Form::text('jumlah', null, ['class' => 'form-control rupiah', 'placeholder' =>
                                'Masukkan Jumlah']) !!}
                                <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                            </div>
                        </div>
                    </div>

                    {!! Form::submit('SIMPAN DATA', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection