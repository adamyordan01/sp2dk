<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Letter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class LetterPolicy
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
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Letter $letter)
    {
        return $user->letterTaxpayer->contains($letter->id) || $user->letterTaxpayerKasi->contains($letter->id);
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
        return $position == "Kepala Seksi" || $position == "Account Representative" || $position == "Pelaksana Seksi";
    }

    public function import(User $user)
    {
        $position = $user->position->nama_jabatan;
        return $position == "Kepala Seksi" || $position == "Operator Console" || $position == "Pelaksana Seksi" || $position == "Account Representative" || $position == "Kepala Subbag" || $position == "Pelaksana Suki";
    }

    public function firstAuthorize(User $user)
    {
        $position = $user->position->nama_jabatan;
        return $position == "Kepala Seksi" || $position == "Account Representative" || $position == "Pelaksana Seksi";
    }

    public function secondAuthorize(User $user)
    {
        $position = $user->position->nama_jabatan;

        return $position != "Kepala Kantor" && $position != "Account Representative";
    }

    public function thirdAuthorize(User $user)
    {
        $position = $user->position->nama_jabatan;
        return $position == "Kepala Seksi" || $position == "Account Representative";
    }

    public function update(User $user, Letter $letter)
    {
        // return $user->position->nama_jabatan != "Kepala Kantor";
        $position = $user->position->nama_jabatan;
        return $position != "Kepala Kantor" && $position != "Operator Console" && $position != "Kepala Seksi Penjamin Kualitas Data";
    }

    public function delete(User $user, Letter $letter)
    {
        $position = $user->position->nama_jabatan;
        return $position == "Kepala Seksi" || $position == "Operator Console";
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Letter $letter)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Letter  $letter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Letter $letter)
    {
        //
    }
}
