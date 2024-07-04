<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'satuan_kerja';

    protected $primaryKey = 'stk_id';

    public function panitia()
    {
        return $this->hasMany(Panitia::class, 'stk_id', 'stk_id');
    }
}
