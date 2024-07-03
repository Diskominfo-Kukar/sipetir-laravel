<?php

namespace App\Models\Paket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komen extends Model
{
    use HasFactory;

    protected $table = 'komens';

    protected $logName = 'komens';

    protected $logOnly = ['*'];

    protected $fillable = ['isi'];

    public function paketDokumens()
    {
        return $this->belongsToMany(PaketDokumen::class, 'dokumen_komen', 'komen_id', 'paket_dokumen_id');
    }
}
