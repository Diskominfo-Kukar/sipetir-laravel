<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokmil extends Model
{
    use SoftDeletes, UsesUuid;

    protected $table = 'pokmil';

    protected $logName = 'pokmil';

    protected $logOnly = ['*'];

    protected $fillable = ['*'];

    public function satuan_kerja()
    {
        return $this->belongsTo(Satker::class, 'satker_id', 'id');
    }

    public function panitia()
    {
        return $this->belongsToMany(Panitia::class, 'panitia_pokmil_pivot', 'pokmil_id', 'panitia_id')->withTimestamps();
    }
}
