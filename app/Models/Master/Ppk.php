<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppk extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'ppk';

    protected $logName = 'ppk';

    protected $logOnly = ['*'];

    protected $fillable = ['ppk_id', 'panitia_id'];

    public function panitia(): BelongsTo
    {
        return $this->belongsTo(Panitia::class, 'panitia_id', 'id');
    }
}
