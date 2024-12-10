<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Services\TeamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TeamController extends BaseController
{
     /**
     * Construct
     *
     * @param  mixed  $service
     * @return void
     */
    public function __construct(
        protected TeamService $service
    ) {
    }

    /**
     * Display all of the resource.
     */
    public function index(): JsonResponse
    {
        try {

            return $this->sendResponse($this->service->all(), 'Dados dos times retornados com sucesso.');

        } catch (\Exception $e) {

            Log::info('Error index TeamController: '.$e->getMessage().' Line: '.$e->getLine());

            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid): JsonResponse
    {
        try {

            $data = $this->service->find($uuid);

            if (is_null($data)) {

                return $this->sendError('Time não encontrado.');

            }

            return $this->sendResponse($data, 'Dados do time retornados com sucesso.');

        } catch (\Exception $e) {

            Log::info('Error show TeamController: '.$e->getMessage().' Line: '.$e->getLine());
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamCreateRequest $request): JsonResponse
    {
        try {

            $data = $this->service->store($request);

            return $this->sendResponse($data);

        } catch (\Exception $e) {

            Log::info('Error store TeamController: '.$e->getMessage().' Line: '.$e->getLine());

            return $this->sendError('Error: ', $e->getMessage());

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamUpdateRequest $request, string $uuid): JsonResponse
    {
        try {

            $data = $this->service->update($request, $uuid);

            return $this->sendResponse($data);

        } catch (\Exception $e) {

            Log::info('Error update TeamController: '.$e->getMessage().' Line: '.$e->getLine());

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

            return $this->sendResponse([], 'Time removido com sucesso!');

        } catch (\Exception $e) {

            Log::info('Error destroy TeamController: '.$e->getMessage().' Line: '.$e->getLine());
            
            return $this->sendError('Error: ', $e->getMessage());

        }
    }

}
