<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use App\Http\Requests\StoreMasjidRequest;
use App\Http\Requests\UpdateMasjidRequest;
use Illuminate\Http\Request;

class MasjidController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masjidId = auth()->user()->masjid_id;
        $masjid = Masjid::find($masjidId);

        return view('masjid_form', [
            'masjid'    => $masjid,
            'title'     => 'Form Masjid',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'telp'      => 'required',
            'email'     => 'required',
        ]);

        $masjidId = auth()->user()->masjid_id;
        $masjid = Masjid::find($masjidId);

        $masjid = $masjid ?? new Masjid();

        $masjid->nama   = $data['nama'];
        $masjid->alamat = $data['alamat'];
        $masjid->telp   = $data['telp'];
        $masjid->email  = $data['email'];
        $masjid->save();

        $user = auth()->user();

        $user->masjid_id = $masjid->id;
        $user->save();

        flash('Data berhasil disimpan')->success();
        return back();
    }
}
