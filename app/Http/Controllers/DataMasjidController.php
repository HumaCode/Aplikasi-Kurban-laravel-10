<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Http\Request;

class DataMasjidController extends Controller
{
    public function show($slug)
    {
        $data = [
            'masjid' => Masjid::where('slug', $slug)->firstOrFail(),
        ];

        return view('data_masjid_show', $data);
    }

    public function profil($slugMasjid, $slugProfil)
    {
        $masjid = Masjid::where('slug', $slugMasjid)->firstOrFail();

        $data = [
            'masjid' => $masjid,
            'profil' => $masjid->profils()->where('slug', $slugProfil)->firstOrFail(),
        ];

        return view('data_masjid_profil', $data);
    }

    public function informasi($slugMasjid, $slugInformasi)
    {
        $masjid = Masjid::where('slug', $slugMasjid)->firstOrFail();

        $data = [
            'masjid'    => $masjid,
            'informasi' => $masjid->informasi()->where('slug', $slugInformasi)->firstOrFail(),
        ];

        return view('data_masjid_informasi', $data);
    }
}
