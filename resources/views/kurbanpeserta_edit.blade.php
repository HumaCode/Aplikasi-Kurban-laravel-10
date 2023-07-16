@extends('layouts.app_adminkit')

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ strtoupper($subtitle) }}</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        @if ($model->status_bayar == 'lunas')
                            <div class="alert alert-success">
                                <strong class="text-secondary"><i class="fas fa-check-circle fa-lg"></i> &nbsp; PEMBAYARAN
                                    {{ strtoupper($model->getStatusText()) }}
                                </strong>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <strong class="text-secondary"><i class="fas fa-times-circle fa-lg"></i> &nbsp; PEMBAYARAN
                                    {{ strtoupper($model->getStatusText()) }}
                                </strong>
                            </div>
                        @endif

                        {!! Form::model($model, [
                            'route' => $route,
                            'method' => $method,
                        ]) !!}

                        {!! Form::hidden('kurban_id', $kurban->id) !!}

                        <div class="mb-3">
                            {!! Form::label('kurban_hewan_id', 'Pilih Hewan Kurban *', ['class' => 'form-label']) !!}
                            {!! Form::select('kurban_hewan_id', $listKurbanHewan, null, [
                                'class' => 'form-control',
                                'placeholder' => '-- Pilih --',
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('kurban_hewan_id') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('total_bayar', 'Total Bayar', ['class' => 'form-label']) !!}
                            {!! Form::text('total_bayar', null, ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('total_bayar') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('tanggal_bayar', 'Tanggal Bayar', ['class' => 'form-label']) !!}
                            {!! Form::date('tanggal_bayar', now(), ['class' => 'form-control']) !!}
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
