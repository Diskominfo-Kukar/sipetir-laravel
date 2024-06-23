<?php

namespace App\Models\Paket;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketDokumen extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'paket_dokumen';

    protected $logName = 'paket_dokumen';

    protected $logOnly = ['*'];

    protected $fillable = ['paket_id', 'jenis_dokumen_id', 'file'];
}
