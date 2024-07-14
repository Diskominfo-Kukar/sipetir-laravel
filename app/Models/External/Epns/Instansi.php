<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'instansi';

    protected $primaryKey = 'id';

    protected $keyType = 'string';
}
