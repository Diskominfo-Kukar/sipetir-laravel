<?php

namespace App\Models\Master;

use App\Models\User;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Panitia extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'panitia';

    protected $logName = 'panitia';

    protected $logOnly = ['*'];

    protected $fillable = ['nama', 'nik', 'nip', 'no_hp', 'user_id', 'jabatan_id'];

    public function setNikAttribute($value)
    {
        $this->attributes['nik']  = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the phone associated with the Jabatan.
     */
    public function hasJabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function jabatan(): Attribute
    {
        return new Attribute(
            get: fn () => isset($this->hasJabatan) ? $this->hasJabatan->nama : ''
        );
    }

    /**
     * Get the phone associated with the Users.
     */
    public function hasUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function username(): Attribute
    {
        return new Attribute(
            get: fn () => isset($this->hasUser) ? $this->hasUser->username : ''
        );
    }

    public function email(): Attribute
    {
        return new Attribute(
            get: fn () => isset($this->hasUser) ? $this->hasUser->email : ''
        );
    }
}
