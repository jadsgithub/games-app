<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * UsersTest: test_index
     * * php artisan test --filter=UsersTest::test_users_index
     */
    public function test_users_index(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->get(route('users.index'));

        $this->assertJson($response->getContent());

        $response->assertStatus(200);
    }

    /**
     * UsersTest: test_show
     * * php artisan test --filter=UsersTest::test_users_show
     */
    public function test_users_show(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->get(route('users.show', $user->uuid));

        $this->assertJson($response->getContent());

        $response->assertStatus(200);
    }

    /**
     * UsersTest: test_store
     * * php artisan test --filter=UsersTest::test_users_store
     */
    public function test_users_store(): void
    {
        
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $payload = User::factory()->make()->toArray();

        $payload['password'] = 'secret_password';
        $payload['password_confirmation'] = 'secret_password';

        $response = $this->post(route('users.store'), $payload);

        $response->assertStatus(200);

    }

    /**
     * UsersTest: test_store_validation
     * * php artisan test --filter=UsersTest::test_users_store_validation
     */
    public function test_users_store_validation(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->post(route('users.store'), []);

        $response->assertStatus(302);
    }

    /**
     * UsersTest: test_update
     * * php artisan test --filter=UsersTest::test_users_update
     */
    public function test_users_update(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $payload = User::factory()->make()->toArray();

        $response = $this->put(route('users.update', $user->uuid), $payload);

        $response->assertStatus(200);
    }

    /**
     * UsersTest: test_update_validation
     * * php artisan test --filter=UsersTest::test_users_update_validation
     */
    public function test_users_update_validation(): void
    {
        $response = $this->put(route('users.update', 999999), []);

        $response->assertStatus(302);
    }

    /**
     * UsersTest: test_destroy
     * * php artisan test --filter=UsersTest::test_users_destroy
     */
    public function test_users_destroy(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->delete(route('users.destroy', $user->uuid));

        $response->assertStatus(403);
    }
}
