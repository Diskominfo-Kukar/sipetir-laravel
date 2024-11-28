<?php

namespace App\Models\Paket;

use App\Models\Master\SumberDana;
use App\Models\Master\SumberDanaSub;
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
        'satker',
        'sumber_dana',
        'sumber_dana_sub',
        'pagu',
        'hps',
        'dpa',
        'tahun',
        'lokasi',
        'lokasi_ba',
        'jam_mulai',
        'intro',
        'jam_berakhir',
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
