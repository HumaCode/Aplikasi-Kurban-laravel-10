<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KurbanPeserta extends Model
{
    use HasFactory, HasCreatedBy, HasMasjid;

    protected $guarded = [];

    /**
     * Get the peserta that owns the KurbanPeserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class);
    }

    /**
     * Get the kurbanHewan that owns the KurbanPeserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kurbanHewan(): BelongsTo
    {
        return $this->belongsTo(KurbanHewan::class);
    }

    public function getStatusText(): String
    {
        if ($this->status_bayar == 'lunas') {
            return 'Lunas';
        } else {
            return 'Belum Lunas';
        }
    }
}
