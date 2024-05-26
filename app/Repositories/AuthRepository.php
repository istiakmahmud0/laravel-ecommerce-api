<?php

namespace App\Repositories;

use App\Http\Resources\RoleResource;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function __construct(protected User $model)
    {
        $this->model = $model;
    }

    /**
     * User login
     */

    public function login(string $email, string $password): User|null
    {

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            // $user['role'] = new RoleResource($user->roles->first());
            $user['accessToken'] = $user->createToken('MyApp')->accessToken;
            $user['role'] = new RoleResource($user->roles->first());
            return $user;
        } else {
            return null;
        }
    }
}
