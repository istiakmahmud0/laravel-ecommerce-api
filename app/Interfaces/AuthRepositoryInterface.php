<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    /**
     * User login
     */

    public function login(string $email, string $password): User|null;

    /**
     * User register
     */
    public function register(array $userData): User;


    /**
     * User refresh token
     */

    // public function refresh(array $data): array;

    public function logout(): void;
}
