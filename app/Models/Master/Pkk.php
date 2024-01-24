<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pkk extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'pkk';

    protected $logName = 'pkk';

    protected $logOnly = ['*'];

    protected $fillable = ['nama', 'user_id'];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}