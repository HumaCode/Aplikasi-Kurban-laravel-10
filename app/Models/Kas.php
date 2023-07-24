<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get all of the comments for the Kas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function infaq(): BelongsTo
    {
        return $this->belongsTo(Infaq::class);
    }
}
