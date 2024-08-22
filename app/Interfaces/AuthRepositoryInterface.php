<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    /**
     * User register
     */
    public function register(array $userData): User;

    /**
     * User login
     */

    public function login(string $email, string $password): User|null;

    /**
     * Reset user password
     */
    public function resetPassword(string $password, string $oldPassword): bool;

    /**
     * Logout user
     */
    public function logout(): void;
}
