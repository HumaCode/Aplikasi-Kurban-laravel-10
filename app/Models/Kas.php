<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory, HasMasjid, HasCreatedBy;

    protected $table = "kas";

    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'datetime:d-m-Y H:i',
    ];

    public function scopeSaldoAkhir($query, $masjidId = null)
    {
        $masjidId = $masjidId ?? auth()->user()->masjid_id;
        $masjid = Masjid::where('id', $masjidId)->first();
        return $masjid->saldo_akhir ?? 0;
    }

    protected static function booted(): void
    {

        // ketika data dibuat
        static::created(function (Kas $kas) {
            $saldoAkhir = Kas::SaldoAkhir();
            if ($kas->jenis == 'masuk') {
                $saldoAkhir += $kas->jumlah;
            } else {
                $saldoAkhir -= $kas->jumlah;
            }

            $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
        });

        // ketika data dihapus
        static::deleted(function (Kas $kas) {
            $saldoAkhir = Kas::SaldoAkhir();
            if ($kas->jenis == 'masuk') {
                $saldoAkhir -= $kas->jumlah;
            } else {
                $saldoAkhir += $kas->jumlah;
            }

            $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
        });

        // ketika data diedit
        static::updated(function (Kas $kas) {
            $saldoAkhir = Kas::SaldoAkhir();
            if ($kas->jenis == 'masuk') {
                $saldoAkhir -= $kas->getOriginal('jumlah');
                $saldoAkhir += $kas->jumlah;
            } else {
                $saldoAkhir += $kas->getOriginal('jumlah');
                $saldoAkhir -= $kas->jumlah;
            }

            $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
        });
    }
}
