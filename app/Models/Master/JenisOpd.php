<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class JenisOpd extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'jenis_opd';

    protected $logName = 'jenis_opd';

    protected $logOnly = ['*'];

    protected $fillable = ['nama'];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function opd(): HasMany
    {
        return $this->hasMany(Opd::class, 'jenis_opd_id', 'id');
    }
}
