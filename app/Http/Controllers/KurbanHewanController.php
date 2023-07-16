<?php

namespace App\Http\Controllers;

use App\Models\KurbanHewan;
use App\Http\Requests\StoreKurbanHewanRequest;
use App\Http\Requests\UpdateKurbanHewanRequest;
use App\Models\Kurban;

class KurbanHewanController extends Controller
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
            'model'         =>  new KurbanHewan(),
            'title'         => 'Informasi Hewan Kurban',
            'subtitle'      => 'Tambah Hewan Kurban',
            'route'         => 'kurbanhewan.store',
            'method'        => 'POST',
            'kurban'        => $kurban,
        ];

        return view('kurbanhewan_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanHewanRequest $request)
    {
        KurbanHewan::create($request->validated());

        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(KurbanHewan $kurbanHewan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KurbanHewan $kurbanhewan)
    {
        // filter data
        $kurban = Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        $data = [
            'model'         =>  $kurbanhewan,
            'title'         => 'Informasi Hewan Kurban',
            'subtitle'      => 'Ubah Hewan Kurban',
            'route'         => ['kurbanhewan.update', $kurbanhewan->id],
            'method'        => 'PUT',
            'kurban'        => $kurban,
        ];

        return view('kurbanhewan_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanHewanRequest $request, KurbanHewan $kurbanhewan)
    {
        $kurbanhewan->update($request->validated());

        flash('Data berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KurbanHewan $kurbanhewan)
    {
        Kurban::UserMasjid()->where('id', request('kurban_id'))->firstOrFail();

        $kurbanhewan->delete();

        flash('Data berhasil dihapus');
        return back();
    }
}
