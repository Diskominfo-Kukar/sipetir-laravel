<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'sumber_dana';

    protected $primaryKey = 'sbd_id';
}
