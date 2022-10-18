<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class ProduksiPolicy
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
    public function aksesTambahProduksi(User $user)
    {
        return ($user->role == 'supervisor'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Supervisor)')
        );
    }
    public function aksesSelesaiProduksi(User $user)
    {
        return ($user->role == 'supervisor'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Supervisor)')
        );
    }
    public function aksesTambahKeteranganTahapan(User $user)
    {
        return ($user->role == 'manajer'
            ? Response::allow()
            : Response::deny('Anda Tidak Berhak Mengakses Halaman ini !!  (Hanya Manajer)')
        );
    }
}
