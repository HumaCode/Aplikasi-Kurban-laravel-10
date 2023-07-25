<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Masjid extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama')
            ->saveSlugsTo('slug');
    }

    /**
     * Get all of the profils for the Masjid
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profils(): HasMany
    {
        return $this->hasMany(Profil::class);
    }

    /**
     * Get all of the kategori for the Masjid
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kategori(): HasMany
    {
        return $this->hasMany(Kategori::class);
    }

    /**
     * Get all of the informasi for the Masjid
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function informasi(): HasMany
    {
        return $this->hasMany(Informasi::class);
    }
}
