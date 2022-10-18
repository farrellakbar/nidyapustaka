<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class KaryawanPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function aksesDaftar(User $user)
    {
        return ($user->role == 'root'|| $user->role == 'manajer'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Root dan Manajer)')
        );
    }
    public function aksesCrete(User $user)
    {
        return ($user->role == 'root'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Root)')
        );
    }
    public function aksesIndex(User $user)
    {
        return ($user->role == 'supervisor'|| $user->role == 'manajer'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Supervisor dan Manajer)')
        );
    }
}
