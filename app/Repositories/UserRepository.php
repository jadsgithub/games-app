<?php

namespace App\Repositories;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContracts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryContracts
{
    protected static $model = User::class;

    /**
     * Get all Users
     * @return Collection
     */
    public static function getAllUsers(): Collection
    {
        return static::$model::all();
    }

    /**
     * Find user by id
     * @param string $id
     * @return ?Model
     */
    public static function getUserById(string $id): ?Model
    {
        return static::$model::find($id);
    }

    /**
     * Find user by uuid
     * @param string $uuid
     * @return ?Model
     */
    public static function getUserByUuid(string $uuid): ?Model
    {
        return static::$model::where('uuid', $uuid)->first();
    }

    /**
     * Register new user
     * @param array $attributes
     * @return ?Model
     */
    public static function createUser(array $attributes): ?Model
    {
        return static::$model::create($attributes);
    }

    /**
     * Update user
     * @param string $id
     * @param array $attributes
     * @return ?int
     */
    public static function updateUser(string $id, array $attributes): ?int
    {
        return static::$model::where('id', $id)->update($attributes);
    }

    /**
     * Update or create user
     * @param array $conditions
     * @param array $attributes
     * @return ?Model
     */
    public static function updateOrCreateUser(array $conditions, array $attributes): ?Model
    {
        return static::$model::updateOrCreate($conditions, $attributes);
    }

    /**
     * Return first or create user
     * @param array $conditions
     * @param array $attributes
     * @return ?Model
     */
    public static function firstOrCreateUser(array $conditions, array $attributes): ?Model
    {
        return static::$model::firstOrCreate($conditions, $attributes);
    }

    /**
     * Delete user
     * @param string $id
     * @return int
     */
    public static function destroyUser(string $id): int
    {
        return static::$model::destroy($id);
    }

}
