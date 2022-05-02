<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SettingPolicy
{
    use HandlesAuthorization;
    public function settings(User $user): Response
    {
        return $user->hasPermissionTo('Setting') ?
            Response::allow() : Response::deny('You don\'t have permission to show permissions list');
    }
}
