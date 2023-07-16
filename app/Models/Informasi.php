<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory, ConvertContentImageBase64ToUrl, HasCreatedBy, HasMasjid, GenerateSlug;

    protected $guarded = [];
    protected $contentName = 'konten';
}
