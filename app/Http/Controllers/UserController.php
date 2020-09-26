<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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

        return new UserResource($user);
    }
}
