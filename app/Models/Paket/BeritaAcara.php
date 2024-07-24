<?php

namespace App\Models\Paket;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'berita_acara';

    protected $logName = 'berita_acara';

    protected $logOnly = ['*'];

    protected $fillable = [
        'paket_id',
        'kode',
        'nama_paket',
        'jenis_pekerjaan',
        'nama_opd',
        'sumber_dana',
        'pagu',
        'hps',
        'dpa',
        'tahun',
        'lokasi',
        'waktu',
        'uraian',
        'intro',
        'outro',
    ];
}
