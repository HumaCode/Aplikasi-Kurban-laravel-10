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
                    <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Kas</a>
                </div>

                {!! Form::open([
                    'url' => url()->current(),
                    'method' => 'GET',
                    'class' => 'row row-cols-lg-auto g-3 align-items-center',
                ]) !!}

                <div class="col-12">
                    {{-- <label for="inlineFormInputGroupUsername">Tanggal Transaksi</label> --}}
                    <div class="input-group">
                        {!! Form::date('tanggal', null, [
                            'class' => 'form-control',
                            'id' => 'inlineFormInputGroupUsername',
                        ]) !!}
                    </div>
                </div>

                <div class="col-12">
                    {{-- <label for="text">Keterangan Transaksi</label> --}}
                    {!! Form::text('q', request('q'), [
                        'class' => 'form-control',
                        'id' => 'text',
                        'placeholder' => 'Keterangan Transaksi',
                    ]) !!}
                </div>

                <div class="col-12 ">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                {!! Form::close() !!}

                @if (count($kases) > 0)
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="{{ config('app.table-style') }}">
                                    <thead class="text-center table-info">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Dibuat</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Pemasukan</th>
                                            <th>Pengeluaran</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kases as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}.</td>
                                                <td>{{ $item->tanggal->translatedFormat('d-m-Y') }}</td>
                                                <td>{{ $item->createdBy->name }}</td>
                                                <td class="text-center">{{ $item->kategori ?? 'umum' }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td class="text-end">
                                                    {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah, true) : '-' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah, true) : '-' }}
                                                </td>
                                                <td class="text-center">

                                                    <a href="{{ route('kas.edit', $item->id) }}"
                                                        class="btn btn-success btn-sm my-2"><i
                                                            class="fas fa-pencil-alt"></i></a>

                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['kas.destroy', $item->id],
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

                                    <tfoot>
                                        <tr class="fw-bold">
                                            <td colspan="5">TOTAL</td>
                                            <td class="text-end">
                                                {{ formatRupiah($totalPemasukan, true) }}
                                            </td>
                                            <td class="text-end">
                                                {{ formatRupiah($totalPengeluaran, true) }}
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="alert alert-info text-end">
                                <strong class="fs-3">Saldo Akhir : {{ formatRupiah($saldoAkhir, true) }}</strong>
                            </div>

                            {{ $kases->links() }}
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <h3 class=" mt-3">Tidak ada data kas.</h3>
                        <img src="{{ asset('images/empty.gif') }}" class="lingkaran" alt="">
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
