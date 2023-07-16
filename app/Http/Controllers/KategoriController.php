<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Kategori::UserMasjid()->latest()->paginate(50);
        $data = [
            'models'        => $models,
            'title'         => 'Kategori Informasi',
        ];
        return view('kategori_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model'         =>  new Kategori(),
            'title'         => 'Kategori Informasi',
            'subtitle'      => 'Tambah Kategori Informasi',
            'route'         => 'kategori.store',
            'method'        => 'POST',
        ];

        return view('kategori_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'nama'          => 'required',
            'keterangan'    => 'nullable',
        ]);

        Kategori::create($requestData);

        flash('Data berhasil disimpan');
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $data = [
            'model'         => $kategori,
            'title'         => 'Kategori Informasi',
            'subtitle'      => 'Ubah Kategori Informasi',
            'route'         => ['kategori.update', $kategori->id],
            'method'        => 'PUT',
        ];

        return view('kategori_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $requestData = $request->validate([
            'nama'          => 'required',
            'keterangan'    => 'nullable',
        ]);

        $kategori->update($requestData);

        flash('Data berhasil diubah');
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // $kategori->delete();

        // flash('Data berhasil dihapus');
        // return back();
    }
}
