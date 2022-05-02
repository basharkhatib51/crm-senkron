<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
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
        return $user->hasPermissionTo('Product') ?
            Response::allow() : Response::deny('You don\'t have permission to show Products list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Product $product
     * @return Response
     */
    public function view(User $user, Product $product): Response
    {
        return $user->hasPermissionTo('Product') ?
            Response::allow() : Response::deny('You don\'t have permission to show this Product');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Product') ?
            Response::allow() : Response::deny('You don\'t have permission to create new Product');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Product $product
     * @return Response
     */
    public function update(User $user, Product $product): Response
    {
        return $user->hasPermissionTo('Product') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Product');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Product $product
     * @return Response
     */
    public function delete(User $user, Product $product): Response
    {
        return $user->hasPermissionTo('Product') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this Product');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Product $product
     * @return Response
     */
    public function restore(User $user, Product $product): Response
    {
        return $user->hasPermissionTo('Product') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this Product');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any Product');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasPermissionTo('Product') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Products');
    }
}
