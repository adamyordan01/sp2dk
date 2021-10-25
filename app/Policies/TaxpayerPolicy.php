<?php

namespace App\Policies;

use App\Models\Taxpayer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxpayerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Taxpayer  $taxpayer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Taxpayer $taxpayer)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $position = $user->position->nama_jabatan;
        return $position == "Account Representative" || $position == "Kepala Seksi";
    }
    
    public function import(User $user)
    {
        $position = $user->position->nama_jabatan;
        return $position == "Kepala Seksi" || $position == "Operator Console" || $position == "Pelaksana Seksi" || $position == "Account Representative";
    }
    

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Taxpayer  $taxpayer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Taxpayer $taxpayer)
    {
        $position = $user->position->nama_jabatan;
        return $position == "Account Representative" || $position == "Kepala Seksi";
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Taxpayer  $taxpayer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Taxpayer $taxpayer)
    {
        $position = $user->position->nama_jabatan;
        // return $position == "Account Representative" || $position == "Kepala Seksi";
        return $position == "Kepala Seksi" || $position == "Operator Console";
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Taxpayer  $taxpayer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Taxpayer $taxpayer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Taxpayer  $taxpayer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Taxpayer $taxpayer)
    {
        //
    }
}
