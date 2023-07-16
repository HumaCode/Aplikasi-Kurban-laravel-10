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
                                    {!! Form::label('hewan', 'Jenis Hewan Kurban *', ['class' => 'form-label']) !!}
                                    {!! Form::select(
                                        'hewan',
                                        [
                                            'sapi' => 'Sapi',
                                            'kambing' => 'Kambing',
                                            'domba' => 'Domba',
                                            'kerbau' => 'Kerbau',
                                            'onta' => 'Onta',
                                        ],
                                        null,
                                        ['class' => 'form-control', 'placeholder' => '-- Pilih Hewan Kurban --'],
                                    ) !!}
                                    <span class="text-danger">{{ $errors->first('hewan') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    {!! Form::label('kriteria', 'Kriteria Hewan (Misal: Kambing Super)', ['class' => 'form-label']) !!}
                                    {!! Form::text('kriteria', $model->kriteria ?? 'Standar', ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first('kriteria') }}</span>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            {!! Form::label('iuran_perorang', 'Iuran Perorang *', ['class' => 'form-label']) !!}
                            {!! Form::text('iuran_perorang', null, ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('iuran_perorang') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('harga', 'Harga Hewan Kurban', ['class' => 'form-label']) !!}
                            {!! Form::text('harga', null, ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('harga') }}</span>
                        </div>

                        <div class="mb-3">
                            {!! Form::label('biaya_operasional', 'Biaya Operasional', ['class' => 'form-label']) !!}
                            {!! Form::text('biaya_operasional', null, ['class' => 'form-control rupiah']) !!}
                            <span class="text-danger">{{ $errors->first('biaya_operasional') }}</span>
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
