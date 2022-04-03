<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param Manager $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Manager $user): bool
    {
        return $user->access_level ===1 || $user->access_level === 2;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param Manager $user
     * @param Group $group
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Manager $user)
    {
        return $user->access_level === 1 || $user->access_level === 2;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param Manager $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Manager $user)
    {
        return $user->access_level === 2;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param Manager $user
     * @return bool
     */
    public function update(Manager $user): bool
    {
        return $user->access_level === 2;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param Manager $user
     * @return bool
     */
    public function delete(Manager $user): bool
    {
        return $user->access_level === 2;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Group $group
     * @return Response|bool
     */
    public function restore(User $user, Group $group)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Group $group
     * @return Response|bool
     */
    public function forceDelete(User $user, Group $group)
    {
        //
    }
}
