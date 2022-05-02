<?php

namespace App\Policies;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SliderPolicy
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
        return $user->hasAnyPermission(['Slider','Page']) ?
            Response::allow() : Response::deny('You don\'t have permission to show Slider list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Slider $slider
     * @return Response
     */
    public function view(User $user, Slider $slider): Response
    {
        return $user->hasPermissionTo('Slider') ?
            Response::allow() : Response::deny('You don\'t have permission to show this Slider');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Slider') ?
            Response::allow() : Response::deny('You don\'t have permission to create new Slider');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Slider $slider
     * @return Response
     */
    public function update(User $user, Slider $slider): Response
    {
        return $user->hasPermissionTo('Slider') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Slider');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Slider $slider
     * @return Response
     */
    public function delete(User $user, Slider $slider): Response
    {
        return $user->hasPermissionTo('Slider') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this Slider');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Slider $slider
     * @return Response
     */
    public function restore(User $user, Slider $slider): Response
    {
        return $user->hasPermissionTo('Slider') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this Slider');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any Slider');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasPermissionTo('Slider') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Sliders');
    }
}
