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
        return in_array('ppk', $user->roles->pluck('name')->toArray()) || in_array('superadmin', $user->roles->pluck('name')->toArray());
    }

    public function viewAdmin(User $user, Paket $paket): bool
    {
        return in_array('Admin', $user->roles->pluck('name')->toArray()) || in_array('superadmin', $user->roles->pluck('name')->toArray());
    }

    public function viewBpbj(User $user, Paket $paket): bool
    {
        return in_array('Kepala BPBJ', $user->roles->pluck('name')->toArray()) || in_array('superadmin', $user->roles->pluck('name')->toArray());
    }

    public function viewPanitia(User $user, Paket $paket): bool
    {
        return in_array('Panitia', $user->roles->pluck('name')->toArray()) || in_array('superadmin', $user->roles->pluck('name')->toArray());
    }
}
