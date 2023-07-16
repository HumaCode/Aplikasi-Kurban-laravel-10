<?php

namespace App\Http\Controllers;

use App\Models\Kurban;
use App\Http\Requests\StoreKurbanRequest;
use App\Http\Requests\UpdateKurbanRequest;
use Illuminate\Http\Request;

class KurbanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurban = Kurban::UserMasjid()->latest()->paginate(50);
        $data = [
            'models'        => $kurban,
            'title'         => 'Informasi Kurban',
        ];
        return view('kurban_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model'         =>  new Kurban(),
            'title'         => 'Informasi Kurban',
            'subtitle'      => 'Tambah Informasi Kurban',
            'route'         => 'kurban.store',
            'method'        => 'POST',
        ];

        return view('kurban_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tahun_masehi'                  => 'required',
            'tahun_hijriah'                 => 'required',
            'tanggal_akhir_pendaftaran'     => 'required',
            'konten'                        => 'required',
        ]);

        Kurban::create($requestData);

        flash('Data berhasil disimpan');
        return redirect()->route('kurban.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurban $kurban)
    {
        $data = [
            'model'         => $kurban,
            'title'         => 'Informasi Kurban',
            'subtitle'      => 'DETAIL',
        ];
        return view('kurban_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurban $kurban)
    {
        $data = [
            'model'         => $kurban,
            'title'         => 'Informasi Kurban',
            'subtitle'      => 'Ubah Informasi Kurban',
            'route'         => ['kurban.update', $kurban->id],
            'method'        => 'PUT',
        ];

        return view('kurban_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kurban $kurban)
    {
        $requestData = $request->validate([
            'tahun_masehi'                  => 'required',
            'tahun_hijriah'                 => 'required',
            'tanggal_akhir_pendaftaran'     => 'required',
            'konten'                        => 'required',
        ]);

        $kurban->update($requestData);

        flash('Data berhasil diubah');
        return redirect()->route('kurban.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurban $kurban)
    {
        $kurban->delete();

        flash('Data berhasil dihapus');
        return back();
    }
}
