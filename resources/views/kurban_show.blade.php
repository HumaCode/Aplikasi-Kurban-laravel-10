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

                        <h3>Tahun Kurban {{ $model->tahun_hijriah . '/' . $model->tahun_masehi }}</h3>
                        <h6>&nbsp; <i class="align-middle" data-feather="calendar"></i>Tanggal Akhir Pendaftaran :
                            <strong>{{ $model->tanggal_akhir_pendaftaran->format('d-m-Y') }}</strong>
                        </h6>
                        <h6>&nbsp; <i class="align-middle" data-feather="user"></i>Created By :
                            <strong>{{ $model->createdBy->name }}</strong>
                        </h6>
                        <p>{!! $model->konten !!}</p>
                        <hr>

                        <h3>Data Hewan Kurban</h3>

                        @if ($model->kurbanHewan->count() >= 1)
                            <div class="text-end mb-3">
                                <a href="{{ route('kurbanhewan.create', ['kurban_id' => $model->id]) }}"
                                    class="btn btn-primary">Buat Baru</a>
                            </div>
                        @endif

                        @if ($model->kurbanHewan->count() == 0)
                            <div class="text-center">Belum ada data.
                                <a href="{{ route('kurbanhewan.create', ['kurban_id' => $model->id]) }}">Buat Baru</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="text-center table-dark">
                                        <tr>
                                            <th width="1%">NO</th>
                                            <th>HEWAN</th>
                                            <th>IURAN</th>
                                            <th>HARGA</th>
                                            <th>BIAYA OPS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($model->kurbanHewan as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}.</td>
                                                <td>{{ ucwords($item->hewan) }} <strong>({{ $item->kriteria }})</strong>
                                                </td>
                                                <td>{{ formatRupiah($item->iuran_perorang, true) }}</td>
                                                <td>{{ formatRupiah($item->harga, true) }}</td>
                                                <td>{{ formatRupiah($item->biaya_operasional, true) }}</td>
                                                <td class="text-center">

                                                    <a href="{{ route('kurbanhewan.edit', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                        class="btn btn-success btn-sm "><i
                                                            class="fas fa-pencil-alt"></i></a>

                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['kurbanhewan.destroy', [$item->id, 'kurban_id' => $item->kurban_id]],
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
                        @endif

                        <hr>
                        <h3>Data Peserta Kurban</h3>
                        {{-- peserta kurban --}}
                        @if ($model->kurbanPeserta->count() >= 1)
                            <div class="text-end mb-3">
                                <a href="{{ route('kurbanpeserta.create', ['kurban_id' => $model->id]) }}"
                                    class="btn btn-primary">Buat Baru</a>
                            </div>
                        @endif

                        @if ($model->kurbanPeserta->count() == 0)
                            <div class="text-center">Belum ada data.
                                <a href="{{ route('kurbanpeserta.create', ['kurban_id' => $model->id]) }}">Pendaftaran
                                    Baru</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="text-center table-dark">
                                        <tr>
                                            <th width="1%">NO</th>
                                            <th>NAMA</th>
                                            <th>NO. HP</th>
                                            <th>ALAMAT</th>
                                            <th>JENIS HEWAN</th>
                                            <th>STATUS PEMBAYARAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($model->kurbanPeserta as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}.</td>
                                                <td>
                                                    <div class="mb-1">{{ $item->peserta->nama }}</div>
                                                    <div class="">
                                                        <small>({{ $item->peserta->nama_tampilan }})</small>
                                                    </div>
                                                </td>
                                                <td>{{ $item->peserta->nohp }}</td>
                                                <td>{{ $item->peserta->getAlamatText() }}</td>
                                                <td>
                                                    <small
                                                        class="mb-2"><strong>{{ ucwords($item->kurbanHewan->hewan) }}</strong></small>
                                                    <br>
                                                    <small class="mb-1">{{ $item->kurbanHewan->kriteria }}</small><br>
                                                    <small>{{ formatRupiah($item->kurbanHewan->iuran_perorang, true) }}</small>
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->status_bayar == 'lunas')
                                                        <span
                                                            class="badge badge-pill badge-success">{{ $item->getStatusText() }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ $item->getStatusText() }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">

                                                    @if ($item->status_bayar != 'lunas')
                                                        <a href="{{ route('kurbanpeserta.edit', [$item->id, 'kurban_id' => $item->kurban_id]) }}"
                                                            class="btn btn-success btn-sm "><i
                                                                class="fas fa-money-bill-wave"></i></a>

                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['kurbanpeserta.destroy', [$item->id, 'kurban_id' => $item->kurban_id]],
                                                            'style' => 'display:inline',
                                                        ]) !!}

                                                        @csrf

                                                        <button type="submit" class="btn btn-danger btn-sm my-2"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data kas ini?')"><i
                                                                class="fas fa-trash"></i></button>
                                                        {!! Form::close() !!}
                                                    @else
                                                        <i class="fas fa-check-circle fa-lg text-success"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
