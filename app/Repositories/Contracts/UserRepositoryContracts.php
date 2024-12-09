<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryContracts
{
    public static function getAllUsers(): Collection;

    public static function getUserById(string $id): ?Model;

    public static function getUserByUuid(string $uuid): ?Model;

    public static function createUser(array $attributes): ?Model;

    public static function updateUser(string $id, array $attributes): ?int;

    public static function updateOrCreateUser(array $conditions, array $attributes): ?Model;

    public static function firstOrCreateUser(array $conditions, array $attributes): ?Model;

    public static function destroyUser(string $id): int;

}