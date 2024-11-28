<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
    use UsesUuid;

    protected $table = 'sumber_dana';

    protected $fillable = [
        'nama',
    ];

    public function sub()
    {
        return $this->hasMany(SumberDanaSub::class);
    }
}
