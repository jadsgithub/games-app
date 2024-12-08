<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected static $model;

    public static function loadModel(): Model
    {
        return app(static::$model);
    }

    public static function all(): Collection
    {
        return self::loadModel()::all();
    }

    public static function find(string $id): ?Model
    {
        return self::loadModel()->find($id);
    }

    public static function store(array $attributes): ?Model
    {
        return self::loadModel()->create($attributes);
    }

    public static function update(string $id, array $attributes): ?int
    {
        $model = self::loadModel()->find($id);
        return $model->update($attributes);
    }

    public static function updateOrCreate(array $conditions, array $attributes): ?Model
    {
        return self::loadModel()->updateOrCreate($conditions, $attributes);
    }

    public static function firstOrCreate(array $conditions, array $attributes): ?Model
    {
        return self::loadModel()->firstOrCreate($conditions, $attributes);
    }

    public static function delete(string $id): int
    {
        $model = self::loadModel()->find($id);
        $model->update(['status' => 'excluido']);
        return $model->delete();
    }

    public static function firstByUuid(string $uuid): ?Model
    {
        return self::loadModel()->where('uuid', $uuid)->first();
    }
}
