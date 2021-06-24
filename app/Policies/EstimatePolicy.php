<?php

namespace App\Policies;

use App\Models\Estimate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstimatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if(!$user->can('view_estimate')){
            return abort(400, 'User can not see the list of estimates.');
        }

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estimate  $estimate
     * @return mixed
     */
    public function view(User $user, Estimate $estimate)
    {
        if(!$user->can('view_estimate')){
            return abort(400, 'User can not see the list of estimates.');
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estimate  $estimate
     * @return mixed
     */
    public function update(User $user, Estimate $estimate)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estimate  $estimate
     * @return mixed
     */
    public function delete(User $user, Estimate $estimate)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estimate  $estimate
     * @return mixed
     */
    public function restore(User $user, Estimate $estimate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estimate  $estimate
     * @return mixed
     */
    public function forceDelete(User $user, Estimate $estimate)
    {
        //
    }
}
