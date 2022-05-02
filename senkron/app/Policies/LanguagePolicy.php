<?php

namespace App\Policies;

use App\Models\Language;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LanguagePolicy
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
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Language $language
     * @return Response
     */
    public function view(User $user, Language $language): Response
    {
        return $user->hasPermissionTo('Language') ?
            Response::allow() : Response::deny('You don\'t have permission to show this Language');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response
     */
    public function create(User $user): Response
    {
        return $user->hasPermissionTo('Language') ?
            Response::allow() : Response::deny('You don\'t have permission to create new Language');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Language $language
     * @return Response
     */
    public function update(User $user, Language $language): Response
    {
        return $user->hasPermissionTo('Language') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Language');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Language $language
     * @return Response
     */
    public function delete(User $user, Language $language): Response
    {
        return $user->hasPermissionTo('Language') ?
            Response::allow() : Response::deny('You don\'t have permission to delete this Language');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Language $language
     * @return Response
     */
    public function restore(User $user, Language $language): Response
    {
        return $user->hasPermissionTo('Language') ?
            Response::allow() : Response::deny('You don\'t have permission to restore this Language');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @return Response
     */
    public function forceDelete(): Response
    {
        return Response::deny('You don\'t have permission to force delete any Language');
    }

    public function get_trashed(User $user): Response
    {
        return $user->hasPermissionTo('Language') ? Response::allow() : Response::deny('You don\'t have permission to view trashed Languages');
    }
}
