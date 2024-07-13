<?php

namespace App\Models\External\Epns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Panitia extends Model
{
    protected $connection = 'pgsql';

    protected $table = 'panitia';

    protected $primaryKey = 'pnt_id';

    protected $with = [
        'anggota', 'satker',
    ];

    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(Pegawai::class, 'anggota_panitia', 'pnt_id', 'peg_id')
            ->withPivot('audittype', 'audituser', 'auditupdate', 'agp_jabatan');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'stk_id', 'stk_id');
    }
}
