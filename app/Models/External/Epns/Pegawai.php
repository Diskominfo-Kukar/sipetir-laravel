<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'pegawai';

    protected $primaryKey = 'peg_id';

    protected $with = [
        'satker',
    ];

    protected $hidden = [
        'audittype',
        'audituser',
        'auditupdate',
    ];

    public function panitia()
    {
        return $this->belongsToMany(Panitia::class, 'anggota_panitia', 'peg_id', 'pnt_id')
            ->withPivot('audittype', 'audituser', 'auditupdate', 'agp_jabatan');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id', 'stk_id');
    }
}
