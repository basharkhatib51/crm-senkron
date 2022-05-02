<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TagPolicy
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
        return $user->hasAnyPermission(['Tag','Page','Product']) ?
            Response::allow() : Response::deny('You don\'t have permission to show Tag list');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function view(User $user, Tag $tag): Response
    {
        return $user->hasPermissionTo('Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to show this Tag');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to create new Tag');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function update(User $user, Tag $tag): Response
    {
        return $user->hasPermissionTo('Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Tag');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function delete(User $user, Tag $tag): Response
    {
        return $user->hasPermissionTo('Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this Tag');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Tag $tag
     * @return Response
     */
    public function restore(User $user, Tag $tag): Response
    {
        return $user->hasPermissionTo('Tag') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this Tag');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any Tag');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasPermissionTo('Tag') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Tags');
    }
}
