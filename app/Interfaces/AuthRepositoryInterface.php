<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthRepositoryInterface
{
    /**
     * User login
     */

    public function login(string $email, string $password): User|null;
}
