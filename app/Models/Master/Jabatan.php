<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Jabatan extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'jabatan';

    protected $logName = 'jabatan';

    protected $logOnly = ['*'];

    protected $fillable = ['nama'];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function panitia()
    {
        return $this->hasOne(Panitia::class, 'jabatan_id');
    }
}
