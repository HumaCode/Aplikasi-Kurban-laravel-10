@extends('layouts.app_adminkit_laporan')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="text-center my-4">
            <h2>LAPORAN KAS {{ strtoupper(auth()->user()->masjid->nama) }}</h2>
            <p>{{ auth()->user()->masjid->alamat }}</p>
        </div>



        @if (count($kases) > 0)
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center table-dark">
                            <tr>
                                <th>No</th>
                                <th width="15%">Tanggal</th>
                                <th>Diinput</th>
                                <th>Keterangan</th>
                                <th width="15%">Pemasukan</th>
                                <th>Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kases as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td class="text-center">{{ $item->tanggal->translatedFormat('d-m-Y') }}</td>
                                <td>{{ $item->createdBy->name }}</td>
                                <td>
                                    {{ $item->keterangan }}
                                </td>
                                <td class="text-end">
                                    {{ $item->jenis == 'masuk' ? formatRupiah($item->jumlah, true) : '-'
                                    }}
                                </td>
                                <td class="text-end">
                                    {{ $item->jenis == 'keluar' ? formatRupiah($item->jumlah, true) : '-'
                                    }}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="4" class="text-center">TOTAL</td>
                                <td class="text-end">
                                    <div class="font-weight-bold">{{ formatRupiah($totalPemasukan, true)
                                        }}</div>
                                </td>
                                <td class="text-end">
                                    <div class="font-weight-bold">{{ formatRupiah($totalPengeluaran, true)
                                        }}</div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-end">
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



@endsection