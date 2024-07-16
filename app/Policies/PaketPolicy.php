<?php

namespace App\Policies;

use App\Models\Paket\Paket;
use App\Models\User;

class PaketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewPpk(User $user, Paket $paket): bool
    {
        return in_array('ppk', $user->role->pluck('name')->toArray()) || in_array('superadmin', $user->role->pluck('name')->toArray());
    }

    public function viewAdmin(User $user, Paket $paket): bool
    {
        return in_array('Admin', $user->role->pluck('name')->toArray()) || in_array('superadmin', $user->role->pluck('name')->toArray());
    }

    public function viewBpbj(User $user, Paket $paket): bool
    {
        return in_array('Kepala BPBJ', $user->role->pluck('name')->toArray()) || in_array('superadmin', $user->role->pluck('name')->toArray());
    }

    public function viewPanitia(User $user, Paket $paket): bool
    {
        return in_array('Panitia', $user->role->pluck('name')->toArray()) || in_array('superadmin', $user->role->pluck('name')->toArray());
    }
}
