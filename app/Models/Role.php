<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use UsesUuid;

    protected $primaryKey = 'id';

    public $incrementing = false;

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
