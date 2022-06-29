<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $columns       = ['name', 'email'];
        $sortValue     = $request->input('sort') ?? '';
        $sortColumn    = in_array($sortValue, $columns) ? $sortValue : 'id';
        $sortDirection = $request->input('sortOrder', '1') === '1' ? 'ASC' : 'DESC';

        $users = User::query()
            ->when($request->input('name'), fn($query, $value) => $query->where('name', 'like', '%' . $value . '%'))
            ->when($request->input('email'), fn($query, $value) => $query->where('email', 'like', '%' . $value . '%'))
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(15);

        return UserResource::collection($users);
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
        $attributes = $request->validated();

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::query()->create($attributes);

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
        $attributes = $request->validated();

        if (empty($attributes['password'])) {
            unset($attributes['password']);
            unset($attributes['password_confirmation']);
        } else {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        $user->update($attributes);

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
