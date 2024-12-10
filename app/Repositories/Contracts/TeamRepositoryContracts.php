<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TeamRepositoryContracts
{
    public static function getAllTeams(): Collection;

    public static function getTeamById(string $id): ?Model;

    public static function getTeamByUuid(string $uuid): ?Model;

    public static function createTeam(array $attributes): ?Model;

    public static function updateTeam(string $id, array $attributes): ?int;

    public static function updateOrCreateTeam(array $conditions, array $attributes): ?Model;

    public static function firstOrCreateTeam(array $conditions, array $attributes): ?Model;

    public static function destroyTeam(string $id): int;

}