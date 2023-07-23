<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Infaq extends Model
{
    use HasFactory, HasCreatedBy, HasMasjid;

    protected $guarded = [];

    /**
     * Get the kas associated with the Infaq
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kas(): HasOne
    {
        return $this->hasOne(Kas::class);
    }
}
