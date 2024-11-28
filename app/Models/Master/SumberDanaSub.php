<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDanaSub extends Model
{
    use HasFactory;

    protected $table = 'sumber_dana_subs';

    protected $fillable = [
        'sumber_dana_id',
        'nama',
    ];

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class);
    }
}
