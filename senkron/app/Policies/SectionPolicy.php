<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SectionPolicy
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
        return $user->hasPermissionTo('Section') ?
            Response::allow() : Response::deny('You don\'t have permission to show Section list');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Section $section
     * @return Response
     */
    public function update(User $user, Section $section): Response
    {
        return $user->hasPermissionTo('Section') ?
            Response::allow() : Response::deny('You don\'t have permission to update this Section');
    }
}
