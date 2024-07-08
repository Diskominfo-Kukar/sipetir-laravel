<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class AnggotaPanitia extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'anggota_panitia';

    protected $primaryKey = 'pnt_id';
}
