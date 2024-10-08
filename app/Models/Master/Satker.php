<?php

namespace App\Models\Master;

use App\Models\Paket\Paket;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satker extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'satuan_kerja';

    protected $logName = 'satuan_kerja';

    protected $logOnly = ['*'];

    protected $fillable = ['stk_id', 'nama', 'opd_id', 'alamat', 'telepon'];

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }

    public function pokmil(): HasMany
    {
        return $this->hasMany(Pokmil::class, 'satker_id', 'id');
    }

    public function paket(): HasMany
    {
        return $this->hasMany(Paket::class, 'satker_id', 'id');
    }
}
