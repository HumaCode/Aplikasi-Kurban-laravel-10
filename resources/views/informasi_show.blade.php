@extends('layouts.app_adminkit')

<style>
    .lingkaran {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;
    }
</style>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>{{ strtoupper($subtitle) }}</h2>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-light">
                                <tr>
                                    <td width="400">Judul</td>
                                    <td width="2%">: </td>
                                    <td>{{ $model->judul }}</td>
                                </tr>
                                <tr>
                                    <td>Konten</td>
                                    <td>: </td>
                                    <td>{!! $model->konten !!}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Posting</td>
                                    <td>: </td>
                                    <td>{{ $model->created_at->translatedFormat('l, d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Di Posting Oleh</td>
                                    <td>: </td>
                                    <td>{{ $model->createdBy->name }}</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
