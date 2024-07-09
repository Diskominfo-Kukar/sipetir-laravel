<?php

namespace App\Models\Master;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Opd extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'opd';

    protected $logName = 'opd';

    protected $logOnly = ['*'];

    protected $fillable = ['kode', 'kode_str', 'nama', 'alamat', 'jenis_opd_id'];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function jenis()
    {
        return $this->belongsTo(JenisOpd::class, 'jenis_opd_id', 'id');
    }
}
