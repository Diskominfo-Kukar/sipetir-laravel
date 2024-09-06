<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokmil extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'pokmil';

    protected $logName = 'pokmil';

    protected $logOnly = ['*'];

    protected $fillable = ['pokmil_id', 'nama', 'tahun', 'no_sk', 'alamat', 'satker_id'];

    public function satuan_kerja(): BelongsTo
    {
        return $this->belongsTo(Satker::class, 'satker_id', 'id');
    }

    public function panitia(): BelongsToMany
    {
        return $this->belongsToMany(Panitia::class, 'panitia_pokmil_pivot', 'pokmil_id', 'panitia_id', 'id', 'id')
            ->withPivot('approve')
            ->withTimestamps();
    }
}
