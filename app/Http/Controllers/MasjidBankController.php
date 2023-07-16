<?php

namespace App\Http\Controllers;

use App\Models\MasjidBank;
use App\Http\Requests\StoreMasjidBankRequest;
use App\Http\Requests\UpdateMasjidBankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;

class MasjidBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masjidbank = MasjidBank::UserMasjid()->latest()->paginate(50);
        $data = [
            'models'        => $masjidbank,
            'title'         => 'Informasi Bank Masjid',
        ];
        return view('masjidbank_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model'         =>  new MasjidBank(),
            'title'         => 'Informasi Bank Masjid',
            'subtitle'      => 'Tambah Bank Masjid',
            'route'         => 'masjidbank.store',
            'method'        => 'POST',
            'listBank'      => Bank::pluck('nama_bank', 'id'),
        ];

        return view('masjidbank_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'bank_id'               => 'required|exists:banks,id',
            'nama_rekening'         => 'required',
            'nomor_rekening'        => 'required',
        ]);

        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']);

        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;

        MasjidBank::create($requestData);

        flash('Data berhasil disimpan');
        return redirect()->route('masjidbank.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasjidBank $masjidBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasjidBank $masjidbank)
    {
        $data = [
            'model'         => $masjidbank,
            'title'         => 'Informasi Bank Masjid',
            'subtitle'      => 'Ubah Bank Masjid',
            'route'         => ['masjidbank.update', $masjidbank->id],
            'method'        => 'PUT',
            'listBank'      => Bank::pluck('nama_bank', 'id'),
        ];

        return view('masjidbank_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasjidBank $masjidbank)
    {
        $requestData = $request->validate([
            'bank_id'               => 'required|exists:banks,id',
            'nama_rekening'         => 'required',
            'nomor_rekening'        => 'required',
        ]);

        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']);

        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;

        $masjidbank->update($requestData);

        flash('Data berhasil disimpan');
        return redirect()->route('masjidbank.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasjidBank $masjidbank)
    {
        $masjidbank->delete();

        flash('Data berhasil dihapus');
        return back();
    }
}
