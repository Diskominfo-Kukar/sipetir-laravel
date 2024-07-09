<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'instansi';

    protected $primaryKey = 'id';
}
