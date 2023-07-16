<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kurban extends Model
{
    use HasFactory, ConvertContentImageBase64ToUrl, HasCreatedBy, HasMasjid;

    protected $guarded = [];
    protected $contentName = 'konten';

    protected $casts = [
        'tanggal_akhir_pendaftaran' => 'date',
    ];

    /**
     * Get all of the kurbanHewan for the Kurban
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kurbanHewan(): HasMany
    {
        return $this->hasMany(KurbanHewan::class);
    }
}
