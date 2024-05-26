<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * AuthController constructor
     */
    public function __construct(protected AuthRepositoryInterface $authRepository, protected AuthService $authService)
    {
        $authRepository = $this->authRepository;
        $this->authService = $authService;
    }



    /**
     * Return the token and user current information
     *
     * @return void
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $loginData = $loginRequest->validated();
        $user = $this->authService->login($loginData['email'], $loginData['password']);
        if ($user) {
            return Response::sendResponse("User has been logged in successfully.", ['user' => $user], 200);
        } else {
            return Response::sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);;
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        return Response::sendResponse('User has been registered in successfully.', [
            'user' => $user,
        ], 201);
    }

    // public function register()
    // {
    // }


    // public function refresh(Request $request)
    // {
    //     $data = $request->validate([
    //         'refresh_token' => 'required|string',
    //     ]);

    //     return response()->json($this->authService->refresh($data));
    // }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return Response::sendResponse("User has been logged out successfully", [], 200);
    }
}
