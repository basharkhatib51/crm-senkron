<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
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
        return $user->hasAnyPermission(['Category', 'Product']) ?
            Response::allow() : Response::deny('You don\'t have permission to show Category list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function view(User $user, Category $category): Response
    {
        return $user->hasPermissionTo('Category') ?
            Response::allow() : Response::deny('You don\'t have permission to show this Category');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Category') ?
            Response::allow() : Response::deny('You don\'t have permission to create new Category');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function update(User $user, Category $category): Response
    {
        return $user->hasPermissionTo('Category') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Category');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function delete(User $user, Category $category): Response
    {
        return $user->hasPermissionTo('Category') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this Category');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Category $category
     * @return Response
     */
    public function restore(User $user, Category $category): Response
    {
        return $user->hasPermissionTo('Category') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this Category');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any Category');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasPermissionTo('Category') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Categories');
    }
}
