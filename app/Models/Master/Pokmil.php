<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokmil extends Model
{
    use HasFactory;

    public function panitias()
    {
        return $this->hasMany(Panitia::class);
    }
}
