<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthenticationService
{
    /**
     * Performs user login
     * @return array
     */
    public function login(array $credentials): ?array
    {
        try {

            if (!Auth::attempt($credentials)) {
                return null;
            }
    
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return [
                'user' => $user,
                'token' => $token,
            ];

        } catch (\Exception $e) {

            Log::info('Error login AuthenticationService: '.$e->getMessage().' Line: '.$e->getLine());
            return null;

        }
    }

    /**
     * Performs user logout
     * @return void
     */
    public function logout(User $user): void
    {
        try {

            $user->currentAccessToken()->delete();

        } catch (\Exception $e) {

            Log::info('Error logout AuthenticationService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

}