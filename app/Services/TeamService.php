<?php

namespace App\Services;

use App\Http\Resources\TeamResource;
use App\Repositories\TeamRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class TeamService
{
    public function __construct(
        protected TeamRepository $teamRepository,
    ) {
    }

    /**
     * Returns all resource data
     * @return JsonResource
     */
    public function all(): JsonResource
    {
        try {

            $data = $this->teamRepository::getAllTeams();
            
            return TeamResource::collection($data);

        } catch (\Exception $e) {

            Log::info('Error all TeamService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Returns one resource data
     * @param string $uuid
     * @return ?JsonResource
     */
    public function find(string $uuid): ?JsonResource
    {
        try {

            $data = $this->teamRepository::getTeamByUuid($uuid);

            return (new TeamResource($data));

        } catch (\Exception $e) {

            Log::info('Error find TeamService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Store a newly created resource in storage.
     * @param object $request
     * @return array
     */
    public function store(object $request): array
    {
        try {
            
            $this->teamRepository::createTeam($request->all());           

            return ['message' => 'Usuário cadastrado com sucesso!'];

        } catch (\Exception $e) {

            Log::info('Error store TeamService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Update the specified resource in storage.
     * @param object $request
     * @param string $uuid
     * @return array
     */
    public function update($request, $uuid): array
    {
        try {
            $team = $this->teamRepository::getTeamByUuid($uuid);

            $this->teamRepository::updateTeam($team->id, $request->all());

            return ['message' => 'Usuário atualizado com sucesso!'];

        } catch (\Exception $e) {

            Log::info('Error update TeamService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $uuid
     */
    public function delete(string $uuid): void
    {
        try {

            $team = $this->teamRepository::getTeamByUuid($uuid);

            $this->teamRepository::destroyTeam($team->id);

        } catch (\Exception $e) {

            Log::info('Error delete TeamService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }
}