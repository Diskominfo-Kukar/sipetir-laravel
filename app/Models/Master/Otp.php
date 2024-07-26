<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use UsesUuid;

    protected $table = 'otp';

    protected $fillable = ['modul_id', 'panitia_id', 'message', 'tipe', 'status'];

    protected $casts = [
        'tipe'   => 'integer',
        'status' => 'boolean',
    ];
}
