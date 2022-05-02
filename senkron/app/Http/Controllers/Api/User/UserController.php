<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\ChangeRoleRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdateStatusRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['users' => UserResource::collection(User::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = new User();
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->user_name = $validated['user_name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->status = 'active';
        $user->phone = $validated['phone'];
        $user->avatar_id = $validated['avatar_id'];
        $user->save();
        return $this->Success('User has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->Data(['user' => new UserResource($user)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->user_name = $validated['user_name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->avatar_id = $validated['avatar_id'];
        $user->save();
        return $this->Success('User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return $this->Success('User has been destroyed successfully');
    }

    /**
     * Update password resource in storage.
     *
     * @param ChangePasswordRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function change_password(ChangePasswordRequest $request, User $user): JsonResponse
    {
        $this->authorize('change_password', $user);
        $validated = $request->validated();
        $user->password = Hash::make($validated['password']);
        $user->save();
        return $this->Success('Password has been updated successfully');
    }

    /**
     * Update status resource in storage.
     *
     * @param UpdateStatusRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function change_status(UpdateStatusRequest $request, User $user): JsonResponse
    {
        $this->authorize('change_status', $user);
        $validated = $request->validated();
        $user->status = $validated['status'];
        if ($validated['status'] == 'blocked' && isset($validated['blocked_reason'])) {
            $user->blocked_reason = $validated['blocked_reason'] ?? '';
        } else {
            $user->blocked_reason = '';
        }
        $user->save();
        if ($user->status === 'blocked') {
            $user->tokens()->delete();
        }
        return $this->Success("User has been $user->status successfully");
    }

    /**
     * Update role resource in storage.
     *
     * @param ChangeRoleRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function change_role(ChangeRoleRequest $request, User $user): JsonResponse
    {
        $this->authorize('change_role', $user);
        $validated = $request->validated();
        $user->syncRoles($validated['role_id']);
        return $this->Success("User role has been changed successfully");
    }

    /**
     * Get trashed users.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', User::class);
        $user = new User();
        $user = $user->onlyTrashed();
        return $this->Data(['users' => UserResource::collection($user->get())]);
    }

    /**
     * Restore User.
     *
     * @param User $trashed_user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore(User $trashed_user): JsonResponse
    {
        $this->authorize('restore', $trashed_user);
        $trashed_user->restore();
        return $this->Success('User has been Restored Successfully');
    }
}
