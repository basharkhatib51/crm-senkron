<?php

namespace App\Policies;

use App\Models\Translation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TranslationPolicy
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
        return $user->hasPermissionTo('Translation') ?
            Response::allow() : Response::deny('You don\'t have permission to show Translation list');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Translation $translation
     * @return Response
     */
    public function update(User $user, Translation $translation): Response
    {
        return $user->hasPermissionTo('Translation') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Translation');
    }
}
