<?php

namespace App\Models\Master;

use App\Models\User;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Panitia extends Model
{
    use HasFactory, SoftDeletes, UsesUuid;

    protected $table = 'panitia';

    protected $logName = 'panitia';

    protected $logOnly = ['*'];

    protected $fillable = ['user_id', 'nip', 'nama', 'alamat', 'golongan', 'pangkat', 'jabatan_id', 'telepon', 'no_sk', 'masa_berlaku', 'ttd', 'nik'];

    public function setNikAttribute($value)
    {
        $this->attributes['nik']  = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the phone associated with the Users.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function email(): Attribute
    {
        return new Attribute(
            get: fn () => isset($this->user) ? $this->user->email : ''
        );
    }

    public function pokmil(): BelongsToMany
    {
        return $this->belongsToMany(Pokmil::class, 'panitia_pokmil_pivot', 'panitia_id', 'pokmil_id', 'id', 'id')->withTimestamps();
    }

    public function ppk(): HasOne
    {
        return $this->hasOne(Ppk::class, 'panitia_id', 'id');
    }

    /**
     * Get the no hp.
     */
    protected function noHpTampil(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->telepon ? $this->telepon : '',
        );
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
