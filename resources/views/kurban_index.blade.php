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
                    <h2>{{ strtoupper($title) }}</h2>
                    <a href="{{ route('kurban.create') }}" class="btn btn-primary">Tambah Informasi Kurban</a>
                </div>

                @if (count($models) > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="{{ config('app.table-style') }}">
                                    <thead class="text-center table-info">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Tahun Kurban</th>
                                            <th width="30%">Tanggal Akhir Daftar</th>
                                            <th width="50%">Konten</th>
                                            <th width="10%">Dibuat</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($models as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}.</td>
                                                <td>
                                                    <div>{{ $item->tahun_hijriah }}H / {{ $item->tahun_masehi }}M</div>
                                                </td>
                                                <td>{{ $item->tanggal_akhir_pendaftaran->format('d-m-Y') }}</td>
                                                <td>{{ strip_tags($item->konten) }}</td>

                                                <td>{{ $item->createdBy->name }}</td>
                                                <td class="text-center">

                                                    <a href="{{ route('kurban.edit', $item->id) }}"
                                                        class="btn btn-success btn-sm "><i
                                                            class="fas fa-pencil-alt"></i></a>

                                                    <a href="{{ route('kurban.show', $item->id) }}"
                                                        class="btn btn-warning btn-sm my-2"><i class="fas fa-eye"></i></a>

                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['kurban.destroy', $item->id],
                                                        'style' => 'display:inline',
                                                    ]) !!}

                                                    @csrf

                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data kas ini?')"><i
                                                            class="fas fa-trash"></i></button>
                                                    {!! Form::close() !!}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <h3 class=" mt-3">Tidak ada data.</h3>
                        <img src="{{ asset('images/empty.gif') }}" class="lingkaran" alt="">
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
