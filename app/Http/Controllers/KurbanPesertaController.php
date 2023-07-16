<?php

namespace App\Http\Controllers;

use App\Models\KurbanPeserta;
use App\Http\Requests\StoreKurbanPesertaRequest;
use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdateKurbanPesertaRequest;
use App\Models\Kurban;
use App\Models\KurbanHewan;
use App\Models\Peserta;
use Illuminate\Support\Facades\DB;

class KurbanPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // filter data
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        $data = [
            'model'             =>  new KurbanPeserta(),
            'title'             => 'Informasi Peserta Kurban',
            'subtitle'          => 'Tambah Peserta Kurban',
            'route'             => 'kurbanpeserta.store',
            'method'            => 'POST',
            'kurban'            => $kurban,
            'listKurbanHewan'   => $kurban->kurbanHewan->pluck('nama_full', 'id'),
        ];

        return view('kurbanpeserta_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanPesertaRequest $requestKurbanPeserta, StorePesertaRequest $requestPeserta)
    {
        $requestDataPeserta = $requestPeserta->validated();
        DB::beginTransaction();
        $peserta = Peserta::create($requestDataPeserta);


        $status_bayar = 'belum';
        if ($requestKurbanPeserta->filled('status_bayar')) {
            $status_bayar = 'lunas';
        }

        $requestKurbanPeserta = $requestKurbanPeserta->validated();

        $kurbanHewan = KurbanHewan::UserMasjid()->where('id', $requestKurbanPeserta['kurban_hewan_id'])->firstOrFail();

        $requestKurbanPeserta['total_bayar'] = $requestKurbanPeserta['total_bayar'] ?? $kurbanHewan->iuran_perorang;

        $dataKurbanPeserta = [
            'kurban_id'         => $kurbanHewan->kurban_id,
            'kurban_hewan_id'   => $kurbanHewan->id,
            'peserta_id'        => $peserta->id,
            'total_bayar'       => $requestKurbanPeserta['total_bayar'],
            'tanggal_bayar'     => $requestKurbanPeserta['tanggal_bayar'],
            'status_bayar'      => $status_bayar,
            'metode_bayar'      => 'tunai',
            'bukti_bayar'       => 'lunas',
        ];

        KurbanPeserta::create($dataKurbanPeserta);

        DB::commit();

        flash('Data berhasil disimpan')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanPesertaRequest $request, KurbanPeserta $kurbanPeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanPeserta $kurbanpesertum)
    {
        if ($kurbanpesertum->status_bayar == 'Lunas') {
            flash('Data tidak dapat dihapus, karena sudah lunas')->error();
            return back();
        }

        $kurbanpesertum->delete();

        flash('Data berhasil dihapus')->success();
        return back();
    }
}
