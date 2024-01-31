<?php

namespace App\Models\Paket;

use App\Models\Master\JenisPengadaan;
use App\Models\Master\Opd;
use App\Models\Master\Panitia;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Paket extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'paket';

    protected $logName = 'paket';

    protected $logOnly = ['*'];

    protected $fillable = ['nama', 'nik', 'nip', 'no_hp', 'user_id', 'opd_id'];

    public function setNikAttribute($value)
    {
        $this->attributes['nik']  = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the phone associated with the OPD.
     */
    public function hasOpd(): BelongsTo
    {
        return $this->belongsTo(Opd::class, 'opd_id');
    }

    public function opd(): Attribute
    {
        return new Attribute(
            get: fn () => isset($this->hasOpd) ? $this->hasOpd->nama : ''
        );
    }

    /**
     * Get the phone associated with the Jenis Pengadaan.
     */
    public function hasJenisPengadaan(): BelongsTo
    {
        return $this->belongsTo(JenisPengadaan::class, 'jenis_pengadaan_id');
    }

    public function jenisPengadaan(): Attribute
    {
        return new Attribute(
            get: fn () => isset($this->hasJenisPengadaan) ? $this->hasJenisPengadaan->nama : ''
        );
    }

    /**
     * Get the phone associated with the OPD.
     */
    public function hasPanitia(): BelongsTo
    {
        return $this->belongsTo(Panitia::class, 'panitia_id');
    }

    public function panitia(): Attribute
    {
        return new Attribute(
            get: fn () => isset($this->hasPanitia) ? $this->hasPanitia->nama : ''
        );
    }
}
