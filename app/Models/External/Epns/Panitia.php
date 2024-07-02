<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'panitia';

    protected $primaryKey = 'pnt_id';

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'pnt_id', 'pnt_id');
    }
}
