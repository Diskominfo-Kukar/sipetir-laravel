<?php

namespace App\Models\Paket;

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
        'nama_paket',
        'jenis_pekerjaan',
        'nama_opd',
        'sumber_dana',
        'pagu',
        'hps',
        'dpa',
        'tahun',
    ];
}
