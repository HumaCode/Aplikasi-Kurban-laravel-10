<?php

namespace App\Models;

use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasjidBank extends Model
{
    use HasFactory, HasCreatedBy, HasMasjid;

    protected $guarded = [];
    protected $contentName = 'konten';
}
