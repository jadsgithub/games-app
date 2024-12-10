<?php

namespace App\Repositories;

use App\Models\Teams;
use App\Repositories\Contracts\TeamRepositoryContracts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TeamRepository implements TeamRepositoryContracts
{
    protected static $model = Teams::class;

    /**
     * Get all Teams
     * @return Collection
     */
    public static function getAllTeams(): Collection
    {
        return static::$model::all();
    }

    /**
     * Find Team by id
     * @param string $id
     * @return ?Model
     */
    public static function getTeamById(string $id): ?Model
    {
        return static::$model::find($id);
    }

    /**
     * Find Team by uuid
     * @param string $uuid
     * @return ?Model
     */
    public static function getTeamByUuid(string $uuid): ?Model
    {
        return static::$model::where('uuid', $uuid)->first();
    }

    /**
     * Register new Team
     * @param array $attributes
     * @return ?Model
     */
    public static function createTeam(array $attributes): ?Model
    {
        return static::$model::create($attributes);
    }

    /**
     * Update Team
     * @param string $id
     * @param array $attributes
     * @return ?int
     */
    public static function updateTeam(string $id, array $attributes): ?int
    {
        return static::$model::where('id', $id)->update($attributes);
    }

    /**
     * Update or create Team
     * @param array $conditions
     * @param array $attributes
     * @return ?Model
     */
    public static function updateOrCreateTeam(array $conditions, array $attributes): ?Model
    {
        return static::$model::updateOrCreate($conditions, $attributes);
    }

    /**
     * Return first or create Team
     * @param array $conditions
     * @param array $attributes
     * @return ?Model
     */
    public static function firstOrCreateTeam(array $conditions, array $attributes): ?Model
    {
        return static::$model::firstOrCreate($conditions, $attributes);
    }

    /**
     * Delete Team
     * @param string $id
     * @return int
     */
    public static function destroyTeam(string $id): int
    {
        return static::$model::destroy($id);
    }

}
