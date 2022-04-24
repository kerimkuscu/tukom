<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserFormRequest $request
     *
     * @return UserResource
     */
    public function store(UserFormRequest $request): UserResource
    {
        $user = User::query()->create($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserFormRequest $request
     * @param User            $user
     *
     * @return UserResource
     */
    public function update(UserFormRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return void
     */
    public function destroy(User $user): void
    {
        $user->delete();
    }
}
