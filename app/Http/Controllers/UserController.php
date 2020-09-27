<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * @param UserStoreRequest $request
     * @return UserResource
     */
    public function store(UserStoreRequest $request)
    {
        $input = $request->validated();
        $user = User::create($input);

        event(new UserCreated($user));

        return new UserResource($user);
    }

    /**
     * @param User $user
     * @param UserUpdateRequest $request
     * @return UserResource
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $input = $request->validated();
        $user = $user->fill($input);
        $user->save();

        event(new UserUpdated($user));

        return new UserResource($user);
    }

    /**
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * @param User $user
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        event(new UserDeleted($user));
    }
}
