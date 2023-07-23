<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index(Request $request)
    {
        $query = Kas::UserMasjid();

        if ($request->filled('q')) {
            $query = $query->where('keterangan', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->filled('tanggal_mulai')) {
            $query = $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query = $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }

        $kases = $query->latest()->paginate(10);
        $data = [
            'kases'             => $kases,
            'title'             => 'Data Kas',
            'totalPemasukan'    => $kases->where('jenis', 'masuk')->sum('jumlah'),
            'totalPengeluaran'  => $kases->where('jenis', 'keluar')->sum('jumlah'),
            'saldoAkhir'        => Kas::SaldoAkhir(),
        ];

        if ($request->page == 'laporan') {

            $data2 = [
                'title'             => 'Laporan Kas',
                'kases'             => Kas::UserMasjid()->orderBy('id', 'desc')->get(),
                'totalPemasukan'    => Kas::UserMasjid()->where('jenis', 'masuk')->sum('jumlah'),
                'totalPengeluaran'  => Kas::UserMasjid()->where('jenis', 'keluar')->sum('jumlah'),
                'saldoAkhir'        => Kas::SaldoAkhir(),
            ];

            return view('kas_laporan', $data2);
        }

        return view('kas_index', $data);
    }

    public function create()
    {
        $data = [
            'kas'           =>  new Kas(),
            'disable'       => '',
            'title'         => 'Kas',
            'subtitle'      => 'TAMBAH KAS',
            'saldoAkhir'    => Kas::SaldoAkhir(),
        ];

        return view('kas_form', $data);
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tanggal'       => 'required',
            'kategori'      => 'nullable',
            'keterangan'    => 'required',
            'jenis'         => 'required',
            'jumlah'        => 'required',
        ]);

        // validasi
        $tanggalTransaksi = Carbon::parse($requestData['tanggal']);
        $tahunBulanTransaksi = $tanggalTransaksi->format('Ym');
        $tahunBulanSekarang = Carbon::now()->format('Ym');
        $bulanSekarang = Carbon::now()->translatedFormat('F');
        if ($tahunBulanTransaksi != $tahunBulanSekarang) {
            flash('Data kas gagal ditambahkan, Transaksi hanya bisa dilakukan untuk ' . $bulanSekarang . ' saja.')->error();
            return back();
        }


        $requestData['jumlah'] = str_replace('.', '', $requestData['jumlah']);

        $kas = new Kas();
        $kas->fill($requestData);
        $kas->save();

        flash('Kas berhasil ditambahkan.')->success();
        return redirect()->route('kas.index');
    }

    public function show(Kas $kas)
    {
        return view('kases.show', compact('kas'));
    }

    public function edit($id)
    {
        $data = [
            'kas'           =>  Kas::userMasjid()->findOrFail($id),
            'title'         => 'Kas',
            'subtitle'      => 'UBAH KAS',
            'disable'       => 'disabled',
            'saldoAkhir'    => Kas::SaldoAkhir(),
        ];

        return view('kas_form', $data);
    }

    public function update(Request $request, Kas $ka)
    {
        $requestData = $request->validate([
            'kategori'      => 'nullable',
            'keterangan'    => 'required',
            'jumlah'        => 'required',
        ]);
        $jumlah = str_replace('.', '', $requestData['jumlah']);
        $kas = $ka;

        $requestData['jumlah'] = $jumlah;
        $kas->fill($requestData);
        $kas->save();

        flash('Kas berhasil diubah.')->success();
        return redirect()->route('kas.index');
    }

    public function destroy(Kas $ka)
    {
        $kas            = $ka;

        if ($kas->infaq_id != null) {
            flash('Kas gagal dihapus. Silahkan hapus data melalui data infaq')->error();
            return back();
        }

        $kas->delete();

        flash('Kas berhasil dihapus.')->success();
        return back();
    }
}
