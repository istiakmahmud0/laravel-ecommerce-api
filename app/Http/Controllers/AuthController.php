<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * AuthController constructor
     */
    public function __construct(protected AuthRepositoryInterface $authRepository)
    {
        $authRepository = $this->authRepository;
    }



    /**
     * Return the token and user current information
     *
     * @return void
     */
    public function login(LoginRequest $loginRequest)
    {
        $loginData = $loginRequest->validated();
        $user = $this->authRepository->login($loginData['email'], $loginData['password']);
        if ($user) {
            return Response::sendResponse("Logged in successfully", ['user' => $user], 200);
        } else {
            return Response::sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);;
        }
    }

    // public function register()
    // {
    // }
}
