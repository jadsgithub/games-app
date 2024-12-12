<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
    ) {
    }

    /**
     * Returns all resource data
     * @return JsonResource
     */
    public function all(): ?JsonResource
    {
        try {

            $data = $this->userRepository::getAllUsers();
            
            return UserResource::collection($data);

        } catch (\Exception $e) {

            Log::info('Error all UserService: '.$e->getMessage().' Line: '.$e->getLine());

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

            $data = $this->userRepository::getUserByUuid($uuid);

            return (new UserResource($data));

        } catch (\Exception $e) {

            Log::info('Error find UserService: '.$e->getMessage().' Line: '.$e->getLine());

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
            
            $this->userRepository::createUser(
                [
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => $request->password
                ]
            );           

            return ['message' => 'Usuário cadastrado com sucesso!'];

        } catch (\Exception $e) {

            Log::info('Error store UserService: '.$e->getMessage().' Line: '.$e->getLine());
            return ['message' => 'Erro ao tentar cadastrar o usuário!'];

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
            $user = $this->userRepository::getUserByUuid($uuid);

            $this->userRepository::updateUser($user->id, ['name' => $request->name, 'email' => $request->email]);

            return ['message' => 'Usuário atualizado com sucesso!'];

        } catch (\Exception $e) {

            Log::info('Error update UserService: '.$e->getMessage().' Line: '.$e->getLine());
            return ['message' => 'Erro ao tentar atualizar o usuário!'];

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $uuid
     */
    public function delete(string $uuid): void
    {
        try {

            $user = $this->userRepository::getUserByUuid($uuid);

            $this->userRepository::destroyUser($user->id);

        } catch (\Exception $e) {

            Log::info('Error delete UserService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }
}