<?php

namespace App\Models\Paket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketHistory extends Model
{
    use HasFactory;

    protected $table = 'paket_histories';

    protected $fillable = [
        'paket_id',
        'message',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }
}
