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

    protected $fillable = ['user_id', 'nip', 'nama', 'alamat', 'golongan', 'pangkat', 'jabatan', 'telepon', 'no_sk', 'masa_berlaku', 'nik'];

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

    public function pokmil()
    {
        return $this->belongsTo(Pokmil::class);
    }
}
