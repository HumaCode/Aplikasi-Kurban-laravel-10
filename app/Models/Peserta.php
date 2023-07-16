<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory, HasCreatedBy, HasMasjid;

    protected $guarded = [];

    public function getAlamatText(): String
    {
        if ($this->alamat != null) {
            return $this->alamat;
        } else {
            return '-';
        }
    }
}
