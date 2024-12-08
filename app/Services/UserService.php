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
     */
    public function all(): JsonResource
    {
        try {

            $data = $this->userRepository::all();
            return UserResource::collection($data);

        } catch (\Exception $e) {

            Log::info('Error all UserService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Returns one resource data
     */
    public function find(string $uuid): ?JsonResource
    {
        try {

            $data = $this->userRepository::firstByUuid($uuid);
            return (new UserResource($data));

        } catch (\Exception $e) {

            Log::info('Error find UserService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  object  $request
     */
    public function store($request): array
    {
        try {
            
            $user = $this->userRepository::firstOrCreate(
                ['email' => $request->email],
                [
                    'name' => $request->name,
                    'password' => $request->password
                ]
            );

            if($user->wasRecentlyCreated){              

                return [
                    'exists' => false,
                    'message' => 'Usuário cadastrado com sucesso!'
                ];
            }

            return [
                'exists' => true,
                'message' => 'Este usuário já possui cadastro no sistema.'
            ];

        } catch (\Exception $e) {

            Log::info('Error store UserService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  object  $request
     */
    public function update($request, $uuid): array
    {
        try {
            $user = $this->userRepository::firstByUuid($uuid);

            $existsUser = $this->userRepository::loadModel()
                ->where('id', '!=', $user->id)
                ->where('email', $request->email)
                ->exists();

            if($existsUser){
                return [
                    'exists' => true,
                    'message' => 'Existe outro usuário cadastro com este email.'
                ];
            }

            $this->userRepository::update($user->id, ['name' => $request->name, 'email' => $request->email]);
  
            return [
                'exists' => false,
                'message' => 'Usuário atualizado com sucesso!',
            ];

        } catch (\Exception $e) {

            Log::info('Error update UserService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $uuid): void
    {
        try {

            $user = $this->userRepository::firstByUuid($uuid);
            $this->userRepository::delete($user->id);

        } catch (\Exception $e) {

            Log::info('Error delete UserService: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }
}