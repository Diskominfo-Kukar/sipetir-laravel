<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'paket';

    protected $primaryKey = 'pkt_id';

    protected $with = [
        'panitia',
    ];

    public function panitia()
    {
        return $this->hasOne(Panitia::class, 'pnt_id', 'pnt_id');
    }
}
