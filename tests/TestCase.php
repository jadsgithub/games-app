<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase, CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }
}
