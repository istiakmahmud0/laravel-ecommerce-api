<?php

namespace App\Repositories;

use App\Http\Resources\RoleResource;
use App\Interfaces\AuthRepositoryInterface;
use App\Mail\ForgetMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Illuminate\Support\Str;

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
     * Forget password
     */

    public function forgetPassword(string $email): bool
    {
        if (User::where('email', $email)->doesntExist()) {
            return false;
        }
        // generate random token
        $token = str::random(32);
        // $hashedToken = bcrypt($token);
        PasswordReset::create([
            'email' => $email,
            'token' => $token
        ]);
        // Mail send to user
        Mail::to($email)->send(new ForgetMail($token));
        return true;
    }

    /**
     * Change password
     */

    public function changePassword(string $email, string $password, string $token): bool
    {
        // Retrieve the password reset entry based on the email
        $resetEmail = PasswordReset::where('email', $email)->latest()->first();
        // Check if the resetEmail exists and if the token matches
        if (!$resetEmail || $token !== $resetEmail->token) {
            return false;
        }
        // Update the password
        $user = User::where('email', $email)->first();
        if (!$user) {
            return false;
        }
        // Save the new password
        $user->password = Hash::make($password);
        $user->save();
        // Delete the password reset record
        $resetEmail->delete();
        return true;
    }

    /**
     * Logout user
     */
    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }
}
