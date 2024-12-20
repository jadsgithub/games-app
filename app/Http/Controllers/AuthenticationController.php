<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends BaseController
{
     /**
     * Construct
     *
     * @param  mixed  $service
     * @return void
     */
    public function __construct(
        protected AuthenticationService $service
    ) {
    }

    /**
     * Performs user login
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {

            $data = $this->service->login($request->only(['email', 'password']));
            return $this->sendResponse($data, $data ? 'Usuário logado com sucesso.' : 'Credenciais inválidas.');

        } catch (\Exception $e) {

            Log::info('Error login AuthenticationController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Performs user logout
     */
    public function logout(): JsonResponse
    {
        try {

            $this->service->logout(auth()->user());
            return $this->sendResponse([], 'Logout realizado com sucesso.');

        } catch (\Exception $e) {

            Log::info('Error logout AuthenticationController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Generate external token
     */
    public function generateExternalToken(): JsonResponse
    {
        try {

            $data = $this->service->generateExternalToken();
            return $this->sendResponse($data, 'Token externo gerado com sucesso.');

        } catch (\Exception $e) {

            Log::info('Error generateExternalToken AuthenticationController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }


}
