<?php

namespace App\Policies;

use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ServiceCategoryPolicy
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
        return $user->hasAnyPermission(['ServiceCategory', 'Page']) ?
            Response::allow() : Response::deny('You don\'t have permission to show Service Category list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param ServiceCategory $serviceCategory
     * @return Response
     */
    public function view(User $user, ServiceCategory $serviceCategory): Response
    {
        return $user->hasPermissionTo('ServiceCategory') ?
            Response::allow() : Response::deny('You don\'t have permission to show this Service Category');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('ServiceCategory') ?
            Response::allow() : Response::deny('You don\'t have permission to create new Service Category');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param ServiceCategory $serviceCategory
     * @return Response
     */
    public function update(User $user, ServiceCategory $serviceCategory): Response
    {
        return $user->hasPermissionTo('ServiceCategory') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Service Category');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param ServiceCategory $serviceCategory
     * @return Response
     */
    public function delete(User $user, ServiceCategory $serviceCategory): Response
    {
        return $user->hasPermissionTo('ServiceCategory') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this Service Category');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param ServiceCategory $serviceCategory
     * @return Response
     */
    public function restore(User $user, ServiceCategory $serviceCategory): Response
    {
        return $user->hasPermissionTo('ServiceCategory') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this Service Category');
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
        return $user->hasPermissionTo('ServiceCategory') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Service Categories');
    }
}
