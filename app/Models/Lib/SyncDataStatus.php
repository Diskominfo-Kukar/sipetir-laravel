<?php

namespace App\Models\Lib;

use Illuminate\Database\Eloquent\Model;

class SyncDataStatus extends Model
{
    protected $fillable = [
        'model',
        'row_synced',
        'last_synced',
    ];
}
