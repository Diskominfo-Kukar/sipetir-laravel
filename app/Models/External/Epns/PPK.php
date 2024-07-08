<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class PPK extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'ppk';

    protected $primaryKey = 'ppk_id';

    protected $with = [
        'pegawai',
    ];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'peg_id', 'peg_id');
    }

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'paket_ppk', 'ppk_id', 'pkt_id')
            ->withPivot('audittype', 'audituser', 'auditupdate', 'ppk_jabatan', 'is_active', 'alasan_ganti');
    }
}
