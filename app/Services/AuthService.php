<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;

class AuthService
{


    public function __construct(protected AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    //     public function refresh(array $data): array
    //     {
    //         return $this->authRepository->refresh($data);
    //     }


    public function login(string $email, string $password): User|null
    {
        return $this->authRepository->login($email, $password);
    }
    public function register(array $userData): User
    {
        return $this->authRepository->register($userData);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}
