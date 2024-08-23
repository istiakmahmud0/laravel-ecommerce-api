<?php

namespace App\Http\Controllers;

use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ForgetMail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    /**
     * AuthController constructor
     */
    public function __construct(protected AuthService $authService)
    {
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


    /**
     * User password reset
     */
    public function passwordReset(ResetPasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $updatePassword = $this->authService->resetPassword($validated['password'], $validated['old_password']);
        if ($updatePassword) {
            return Response::sendResponse('Password has been changed successfully', [], 201);
        } else {
            return Response::sendError('Old password doesn\'t match.', [], 200);
        }
    }

    /**
     * Forget password
     */
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request->email;
        if (User::where('email', $email)->doesntExist()) {
            return Response::sendError('Invalid email.', [], 404);
        }
        // generate random token
        $token = Str::random(32);
        // $hashedToken = bcrypt($token);
        PasswordReset::create([
            'email' => $email,
            'token' => $token
        ]);
        // Mail send to user
        Mail::to($email)->send(new ForgetMail($token));
        return Response::sendResponse('Password reset email has been sent your email', [], 200);
    }

    public function changePassword(ChangePasswordRequest $request, string $resetToken)
    {
        // Validate the request
        $validated = $request->validated();

        // Retrieve the password reset entry based on the email
        $resetEmail = PasswordReset::where('email', $validated['email'])->first();


        // Check if the resetEmail exists and if the token matches
        if (!$resetEmail || $resetToken !== $resetEmail->token) {
            return Response::sendError('Invalid email or token.', [], 404);
        }

        // Update the password
        $user = User::where('email', $validated['email'])->first();
        if (!$user) {
            return Response::sendError('User not found.', [], 404);
        }
        // Save the new password
        $user->password = Hash::make($validated['password']);
        $user->save();
        // Delete the password reset record
        $resetEmail->delete();
        return Response::sendResponse('Password has been reset', [], 200);
    }

    /**
     * User logout
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return Response::sendResponse("User has been logged out successfully", [], 200);
    }
}
