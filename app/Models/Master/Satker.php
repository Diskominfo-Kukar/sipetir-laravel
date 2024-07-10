<?php

namespace App\Models\Master;

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

    protected $fillable = ['*'];

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }

    public function pokmil(): HasMany
    {
        return $this->hasMany(Pokmil::class, 'satker_id', 'id');
    }
}
