@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ strtoupper($subtitle) }}</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="alert alert-secondary">
                            <strong>Tanda * Wajid Diisi</strong>
                        </div>

                        {!! Form::model($model, [
                            'route' => $route,
                            'method' => $method,
                        ]) !!}

                        {!! Form::hidden('kurban_id', $kurban->id) !!}

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('nama', 'Nama Peserta *', ['class' => 'form-label']) !!}
                                    {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('nama_tampilan', 'Nama Tampilan *', ['class' => 'form-label']) !!}
                                    {!! Form::text('nama_tampilan', $model->nama_tampilan ?? 'Hamba Allah', ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first('nama_tampilan') }}</span>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            {!! Form::label('nohp', 'No Hp *', ['class' => 'form-label']) !!}
                            {!! Form::text('nohp', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nohp') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('alamat', 'Alamat *', ['class' => 'form-label']) !!}
                            {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('kurban_hewan_id', 'Pilih Hewan Kurban *', ['class' => 'form-label']) !!}
                            {!! Form::select('kurban_hewan_id', $listKurbanHewan, null, [
                                'class' => 'form-control',
                                'placeholder' => '-- Pilih --',
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('kurban_hewan_id') }}</span>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                {!! Form::checkbox('status_bayar', 1, $model->status_bayar ?? false, [
                                    'class' => 'form-check-input',
                                    'id' => 'my-input',
                                ]) !!}
                                <label for="my-input" class="form-check-label">Sudah Melakukan Pembayaran</label>
                            </div>
                            <span class="text-danger">{{ $errors->first('status_bayar') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('total_bayar', 'Total Bayar', ['class' => 'form-label']) !!}
                            {!! Form::text('total_bayar', null, ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('total_bayar') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('tanggal_bayar', 'Tanggal Bayar', ['class' => 'form-label']) !!}
                            {!! Form::date('tanggal_bayar', $model->tanggal_bayar ?? now(), ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                        </div>

                        {!! Form::submit('SIMPAN DATA', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('kurban.show', $kurban->id) }}" class="btn btn-danger">Kembali</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
