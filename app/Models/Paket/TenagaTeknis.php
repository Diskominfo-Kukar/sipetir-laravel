<?php

namespace App\Models\Paket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaTeknis extends Model
{
    use HasFactory;

    protected $table = 'tenaga_teknis';

    protected $fillable = [
        'paket_id',
        'nama',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }
}
