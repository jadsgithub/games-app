<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait Uuid {
    protected static function bootUuid() {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string)Str::uuid();
            }
        });
    }
}