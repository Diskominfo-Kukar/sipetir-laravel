<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'paket';

    protected $primaryKey = 'pkt_id';

    public function panitia()
    {
        return $this->hasOne(Panitia::class, 'pnt_id', 'pnt_id');
    }

    public function ppk()
    {
        return $this->belongsToMany(PPK::class, 'paket_ppk', 'pkt_id', 'ppk_id')
            ->withPivot('audittype', 'audituser', 'auditupdate', 'ppk_jabatan', 'is_active', 'alasan_ganti');
    }
}
