<?php

namespace App\Observers;

use App\Models\Infaq;
use App\Models\Kas;
use Exception;

class InfaqObserver
{
    /**
     * Handle the Infaq "created" event.
     */
    public function created(Infaq $infaq): void
    {
        try {
            if ($infaq->jenis == 'uang') {
                // input ke tabel kas
                $kas = new Kas();
                $kas->infaq_id      = $infaq->id;
                $kas->tanggal       = $infaq->created_at;
                $kas->kategori      = 'Infaq ' . ucwords($infaq->sumber);
                $kas->keterangan    = 'Infaq ' . ucwords($infaq->sumber) . ' dari ' . $infaq->atas_nama;
                $kas->jenis         = 'masuk';
                $kas->jumlah        = $infaq->jumlah;
                $kas->save();
            }
        } catch (\Throwable $th) {
            throw new Exception("Error, Database gagal disimpan");
        }
    }

    /**
     * Handle the Infaq "updated" event.
     */
    public function updated(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            try {
                $kas = $infaq->kas;
                $kas->jumlah = $infaq->jumlah;
                $kas->save();
            } catch (\Throwable $th) {
                throw new Exception("Error, Database gagal diubah");
            }
        }
    }

    /**
     * Handle the Infaq "deleted" event.
     */
    public function deleted(Infaq $infaq): void
    {
        if ($infaq->jenis == 'uang') {
            $infaq->kas->delete();
        }
    }

    /**
     * Handle the Infaq "restored" event.
     */
    public function restored(Infaq $infaq): void
    {
        //
    }

    /**
     * Handle the Infaq "force deleted" event.
     */
    public function forceDeleted(Infaq $infaq): void
    {
        //
    }
}
