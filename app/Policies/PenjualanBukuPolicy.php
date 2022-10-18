<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PenjualanBukuPolicy
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
    public function aksesKeranjangPenjualan(User $user)
    {
        return ($user->role == 'manajer'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Manajer)')
        );
    }
    public function aksesProsesPenjualan(User $user)
    {
        return ($user->role == 'manajer'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Manajer)')
        );
    }
}
