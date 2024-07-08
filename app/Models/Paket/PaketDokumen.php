<?php

namespace App\Models\Paket;

use App\Models\Master\JenisDokumen;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketDokumen extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'paket_dokumen';

    protected $logName = 'paket_dokumen';

    protected $logOnly = ['*'];

    protected $fillable = ['paket_id', 'jenis_dokumen_id', 'file'];

    /**
     * Get kegiatan for Kegiatan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function komens()
    {
        return $this->belongsToMany(Komen::class, 'dokumen_komen', 'paket_dokumen_id', 'komen_id');
    }

    /**
     * Get jenisDokumen for JenisDokumen.
     *
     * @return BelongsTo
     */
    public function jenisDokumen(): BelongsTo
    {
        return $this->belongsTo(JenisDokumen::class);
    }
}
