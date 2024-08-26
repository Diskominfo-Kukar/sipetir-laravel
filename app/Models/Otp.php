<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use UsesUuid;

    protected $table = 'otp';

    protected $fillable = [
        'module_id', 'module_class', 'panitia_id', 'type', 'to', 'code', 'status',
    ];

    protected $casts = [
        'status' => 'integer',
    ];
}
