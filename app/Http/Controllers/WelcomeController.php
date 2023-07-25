<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $data = [
            'masjids' => Masjid::latest()->get(),
        ];

        return view('welcome_index', $data);
    }

    public function konfirm()
    {
        return view('welcome_konfirm');
    }

    public function konfirm_wa(Request $request)
    {
        // $setting = Setting::find(1);
        $phone = 6282324118692;

        // dd($phone);

        $user = User::find($request->id);

        $data = [
            'nama' => $user->name,
            'pesan' => 'Mohon konfirmasi akun saya min.., emailnya : ' . $user->email,
        ];

        // Membangun pesan dengan format teks
        $message = '';
        foreach ($data as $key => $value) {
            $message .= "{$key}: {$value}\n"; // Menggunakan karakter * untuk membuat teks tebal
        }

        // URL Encode pesan
        $message = urlencode($message);

        // Membuat URL untuk mengarahkan pengguna ke WhatsApp Web
        $url = "https://web.whatsapp.com/send?phone={$phone}&text={$message}";

        // Melakukan redirect ke URL WhatsApp Web
        return redirect($url);
    }
}
