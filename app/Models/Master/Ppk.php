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

class Ppk extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'ppk';

    protected $logName = 'ppk';

    protected $logOnly = ['*'];

    protected $fillable = ['nama', 'nik', 'nip', 'no_hp', 'user_id', 'opd_id'];

    public function setNikAttribute($value)
    {
        $this->attributes['nik']  = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the phone associated with the Opd.
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
