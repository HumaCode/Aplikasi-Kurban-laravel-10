<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use App\Http\Requests\StoreInfaqRequest;
use App\Http\Requests\UpdateInfaqRequest;
use App\Models\Kas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfaqController extends Controller
{

    private function listSumberDana()
    {
        return [
            'instansi'      => 'Instansi',
            'perorang'      => 'Per-orangan',
            'kotak amal'    => 'Kotak Amal',
            'lainnya'       => 'Lainnya',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Infaq::UserMasjid();

        if ($request->filled('q')) {
            $query = $query->where('atas_nama', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->filled('tanggal_mulai')) {
            $query = $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query = $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        $infaq = $query->latest()->paginate(50);
        $data = [
            'infaq'             => $infaq,
            'title'             => 'Data Infaq Masjid',
        ];

        if ($request->page == 'laporan') {
            // return view('kas_index', $data);
        }

        return view('infaq_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'query'             =>  new Infaq(),
            'title'             => 'Infaq Masjid',
            'subtitle'          => 'TAMBAH DATA INFAQ',
            'listSumber'        => $this->listSumberDana(),
        ];

        return view('infaq_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfaqRequest $request)
    {
        $requestData = $request->validated();

        DB::beginTransaction();

        $requestData['atas_nama'] = $requestData['atas_nama'] ?? 'Hamba Allah';

        // input ke tabel infaq
        $infaq = Infaq::create($requestData);

        if ($infaq->jenis == 'uang') {
            // input ke tabel kas
            $kas = new Kas();
            $kas->masjid_id     = $request->user()->masjid_id;
            $kas->tanggal       = $infaq->created_at;
            $kas->kategori      = 'Infaq-' . ucwords($infaq->sumber);
            $kas->keterangan    = 'Infaq-' . ucwords($infaq->sumber) . ' dari ' . $infaq->atas_nama;
            $kas->jenis         = 'masuk';
            $kas->jumlah        = $infaq->jumlah;
            $kas->save();
        }

        DB::commit();

        flash('Infaq berhasil disimpan.')->success();
        return redirect()->route('infaq.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Infaq $infaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Infaq $infaq)
    {
        $data = [
            'query'             =>  Infaq::UserMasjid()->findOrFail($infaq->id),
            'title'             => 'Infaq Masjid',
            'subtitle'          => 'UBAH DATA INFAQ',
            'listSumber'        => $this->listSumberDana(),
        ];

        return view('infaq_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInfaqRequest $request, Infaq $infaq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Infaq $infaq)
    {
        //
    }
}
