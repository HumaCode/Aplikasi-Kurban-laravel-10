<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasi = Informasi::UserMasjid()->latest()->paginate(50);
        $data = [
            'models'        => $informasi,
            'title'         => 'Informasi Masjid',
        ];
        return view('informasi_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model'         =>  new Informasi(),
            'title'         => 'Informasi Masjid',
            'subtitle'      => 'Tambah Informasi Masjid',
            'route'         => 'informasi.store',
            'method'        => 'POST',
            'listKategori'  => Kategori::pluck('nama', 'id'),
        ];

        return view('informasi_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori'      => 'required',
            'judul'         => 'required',
            'konten'        => 'required',
        ]);

        Informasi::create($requestData);

        flash('Data berhasil disimpan');
        return redirect()->route('informasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        $data = [
            'model'         => $informasi,
            'title'         => 'Informasi Masjid',
            'subtitle'      => 'DETAIL',
        ];
        return view('informasi_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        $data = [
            'model'         => $informasi,
            'title'         => 'Informasi Masjid',
            'subtitle'      => 'Ubah Informasi Masjid',
            'route'         => ['informasi.update', $informasi->id],
            'method'        => 'PUT',
            'listKategori'  => Kategori::pluck('nama', 'id'),
        ];

        return view('informasi_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        $requestData = $request->validate([
            'kategori'  => 'required',
            'judul'     => 'required',
            'konten'    => 'required',
        ]);

        $informasi->update($requestData);

        flash('Data berhasil diubah');
        return redirect()->route('informasi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();

        flash('Data berhasil dihapus');
        return back();
    }
}
