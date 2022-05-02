<?php

namespace App\Policies;

use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function viewAny(User $user): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to show users list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function view(User $user, User $model): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to show this user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to create new user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function update(User $user, User $model): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to update this user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function delete(User $user, User $model): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this user');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function restore(User $user, User $model): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this user');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any user');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function change_status(User $user, User $model): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to change this user status');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function change_password(User $user, User $model): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to change this user password');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function change_role(User $user, User $model): Response
    {
        return $user->hasPermissionTo('User') ?
            Response::allow() : Response::deny('You don\'t have permission to change this user role');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasPermissionTo('User') ? Response::allow() : Response::deny('You don\'t have permission to view trashed users');
    }

    public function dashboard(User $user): Response
    {
        return $user->hasPermissionTo('Statistic') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Statistics');
    }
}
