<?php

namespace App\Models\Paket;

use App\Models\Master\SumberDana;
use App\Models\Master\SumberDanaSub;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'surat_tugas';

    protected $logName = 'surat_tugas';

    protected $logOnly = ['*'];

    protected $fillable = [
        'paket_id',
        'kode',
        'nama_paket',
        'jenis_pekerjaan',
        'nama_opd',
        'sumber_dana',
        'sumber_dana_sub',
        'pagu',
        'hps',
        'dpa',
        'tahun',
    ];

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class, 'sumber_dana', 'id');
    }

    public function sumberDanaSub()
    {
        return $this->belongsTo(SumberDanaSub::class, 'sumber_dana_sub', 'id');
    }
}
