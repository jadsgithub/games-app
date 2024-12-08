<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public static function loadModel(): Model;

    public static function all(): Collection;

    public static function find(string $id): ?Model;

    public static function store(array $attributes): ?Model;

    public static function update(string $id, array $attributes): ?int;

    public static function updateOrCreate(array $conditions, array $attributes): ?Model;

    public static function firstOrCreate(array $conditions, array $attributes): ?Model;

    public static function delete(string $id): int;

    public static function active(string $id): int;

    public static function inactive(string $id): int;

    public static function firstByUuid(string $uuid): ?Model;
}
