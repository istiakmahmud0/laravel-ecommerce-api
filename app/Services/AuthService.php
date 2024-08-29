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

    public function resetPassword(string $password, string $oldPassword): bool
    {
        return $this->authRepository->resetPassword($password, $oldPassword);
    }

    public function forgetPassword(string $email): bool
    {
        return $this->authRepository->forgetPassword($email);
    }
    public function changePassword(string $email, string $password, string $token): bool
    {
        return $this->authRepository->changePassword($email, $password, $token);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}
