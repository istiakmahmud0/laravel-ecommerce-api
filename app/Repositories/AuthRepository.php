<?php

namespace App\Repositories;

use App\Http\Resources\RoleResource;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

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
            $user['role'] = new RoleResource($user->roles->first());
            $user['accessToken'] = $user->createToken('MyApp')->accessToken;
            return $user;
        } else {
            return null;
        }
    }
    /**
     * User register
     */
    public function register(array $userData): User
    {
        $userData['password'] = bcrypt($userData['password']);
        $userData['email_verified_at'] = now();
        $user = $this->model->create($userData);
        $userData['accessToken'] = $user->createToken('API Token')->accessToken;

        return $user;
    }

    /**
     * Reset user password
     */
    public function resetPassword(string $password, string $oldPassword): bool
    {
        $user = $this->model->find(auth()->id());
        if (Hash::check($oldPassword, $user->password)) {
            return $user->update(['password' => Hash::make($password)]);
        } else {
            return false;
        }
    }


    /**
     * Logout user
     */
    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }
}
