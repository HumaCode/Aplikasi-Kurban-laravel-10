@extends('layouts.app_adminkit_laporan')

<style>
    .lingkaran {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;
    }
</style>

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class=" my-4">
            <div class="text-center">
                <h2><strong>LAPORAN DATA KURBAN TAHUN : {{ $model->tahun_hijriah . 'H/' . $model->tahun_masehi
                        }}M</strong></h2>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <h3>Tahun Kurban {{ $model->tahun_hijriah . '/' . $model->tahun_masehi }}</h3>

                <h6>Tanggal Akhir Pendaftaran :
                    <strong>{{ $model->tanggal_akhir_pendaftaran->format('d-m-Y') }}</strong>
                </h6>
                <h6>Created By :
                    <strong>{{ $model->createdBy->name }}</strong>
                </h6>
                <p>{!! $model->konten !!}</p>
                <hr>

                <h3>Data Hewan Kurban</h3>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center table-dark">
                            <tr>
                                <th width="1%">NO</th>
                                <th>HEWAN</th>
                                <th>IURAN</th>
                                <th>HARGA</th>
                                <th>BIAYA OPERASIONAL</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <hr>
                <h3>Data Peserta Kurban</h3>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center table-dark">
                            <tr>
                                <th width="1%">NO</th>
                                <th>NAMA</th>
                                <th>NO. HP</th>
                                <th>ALAMAT</th>
                                <th>JENIS HEWAN</th>
                                <th>STATUS PEMBAYARAN</th>
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
                                    <small class="mb-2"><strong>{{ ucwords($item->kurbanHewan->hewan)
                                            }}</strong></small>
                                    <br>
                                    <small class="mb-1">{{ $item->kurbanHewan->kriteria }}</small><br>
                                    <small>{{ formatRupiah($item->kurbanHewan->iuran_perorang, true) }}</small>
                                </td>
                                <td class="text-center">
                                    @if ($item->status_bayar == 'lunas')
                                    <span class="">{{ $item->getStatusText() }}</span>
                                    @else
                                    <span class="">{{ $item->getStatusText() }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <h4 class="">Total Peserta : <strong>{{ $model->kurbanPeserta->count() }} </strong>Orang</h4>
                    <h4 class="">Total Sudah Bayar : <strong>{{ $model->kurbanPeserta->where('status_bayar',
                            'lunas')->count() }} </strong>Orang</h4>
                    <h4 class="">Total Sudah Bayar : <strong>{{
                            formatRupiah($model->kurbanPeserta->where('status_bayar',
                            'lunas')->sum('total_bayar'), true) }} </strong></h4>
                    <h4 class="">Total Iuran Peserta : <strong>{{
                            formatRupiah($model->kurbanPeserta->sum('total_bayar'),
                            true) }}</strong></h4>

                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
<script>
    window.print();
</script>
@endpush