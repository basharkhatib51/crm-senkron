<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response
     */
    public function viewAny(User $user): Response
    {
        return $user->hasAnyPermission(['Page','Menu']) ?
            Response::allow() : Response::deny('You don\'t have permission to show Page list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function view(User $user, Page $page): Response
    {
        return $user->hasPermissionTo('Page') ?
            Response::allow() : Response::deny('You don\'t have permission to show this Page');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Page') ?
            Response::allow() : Response::deny('You don\'t have permission to create new Page');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function update(User $user, Page $page): Response
    {
        return $user->hasPermissionTo('Page') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Page');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function delete(User $user, Page $page): Response
    {
        return $user->hasPermissionTo('Page') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this Page');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Page $page
     * @return Response
     */
    public function restore(User $user, Page $page): Response
    {
        return $user->hasPermissionTo('Page') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this Page');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any Page');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasPermissionTo('Page') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Pages');
    }
}
