<?php

namespace App\Models;

use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory, HasCreatedBy, HasMasjid, GenerateSlug;

    protected $guarded = [];

    /**
     * Get all of the informasi for the Kategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function informasi(): HasMany
    {
        return $this->hasMany(Informasi::class);
    }
}
