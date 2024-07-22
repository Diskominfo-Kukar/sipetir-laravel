<?php

namespace App\Models\Lib;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use UsesUuid;

    protected $table = 'notifikasi';

    protected $fillable = ['modul_id', 'panitia_id', 'message', 'tipe', 'status'];

    protected $casts = [
        'tipe'   => 'integer',
        'status' => 'boolean',
    ];
}
