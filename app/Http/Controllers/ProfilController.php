<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::UserMasjid()->latest()->paginate(50);
        $data = [
            'models'        => $profil,
            'title'         => 'Profil Masjid',
        ];
        return view('profil_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'profil'        =>  new Profil(),
            'title'         => 'Profil Masjid',
            'subtitle'      => 'TAMBAH PROFIL',
            'route'         => 'profil.store',
            'method'        => 'POST',
            'listKategori'  => [
                'visi-misi' => 'Visi Misi',
                'sejarah' => 'Sejarah',
                'struktur-organisasi' => 'Struktur Organisasi',
            ],
        ];

        return view('profil_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori'  => 'required',
            'judul'     => 'required',
            'konten'    => 'required',
        ]);

        Profil::create($requestData);

        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        $data = [
            'profil'        => $profil,
            'title'         => 'Profil Masjid',
            'subtitle'      => 'DETAIL',
        ];
        return view('profil_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        $data = [
            'profil'        => $profil,
            'title'         => 'Profil Masjid',
            'subtitle'      => 'UBAH PROFIL',
            'route'         => ['profil.update', $profil->id],
            'method'        => 'PUT',
            'listKategori'  => [
                'visi-misi' => 'Visi Misi',
                'sejarah' => 'Sejarah',
                'struktur-organisasi' => 'Struktur Organisasi',
            ],
        ];

        return view('profil_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profil)
    {
        $requestData = $request->validate([
            'kategori'  => 'required',
            'judul'     => 'required',
            'konten'    => 'required',
        ]);


        $profil = Profil::findOrFail($profil->id);
        $profil->update($requestData);

        flash('Data berhasil diubah');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        $profil->delete();

        flash('Data berhasil dihapus');
        return back();
    }
}
