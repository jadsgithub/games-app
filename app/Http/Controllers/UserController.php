<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
     /**
     * Construct
     *
     * @param  mixed  $service
     * @return void
     */
    public function __construct(
        protected UserService $service
    ) {
    }

    /**
     * Display all of the resource.
     */
    public function index(): JsonResponse
    {
        try {

            return $this->sendResponse($this->service->all(), 'Dados dos usuários retornados com sucesso.');

        } catch (\Exception $e) {

            Log::info('Error index UserController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {

            $data = $this->service->find($id);

            if (is_null($data)) {
                return $this->sendError('Usuário não encontrado.');
            }

            return $this->sendResponse($data, 'Dados do usuário retornados com sucesso.');

        } catch (\Exception $e) {

            Log::info('Error show UserController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {

            $data = $this->service->store($request);
            return $this->sendResponse($data);

        } catch (\Exception $e) {

            Log::info('Error store UserController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $uuid): JsonResponse
    {
        try {

            $data = $this->service->update($request, $uuid);
            return $this->sendResponse($data);

        } catch (\Exception $e) {

            Log::info('Error update UserController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid): JsonResponse
    {
        try {

            $this->service->delete($uuid);
            return $this->sendResponse([], 'Usuário removido com sucesso!');

        } catch (\Exception $e) {

            Log::info('Error destroy UserController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

}
