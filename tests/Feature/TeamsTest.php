<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Teams;
use App\Models\User;
use Tests\TestCase;

class TeamsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
    }

    /**
     * TeamsTest: test_index
     * * php artisan test --filter=TeamsTest::test_teams_index
     */
    public function test_teams_index(): void
    {

        $response = $this->get(route('teams.index'));

        $this->assertJson($response->getContent());

        $response->assertStatus(200);
    }

    /**
     * TeamsTest: test_show
     * * php artisan test --filter=TeamsTest::test_teams_show
     */
    public function test_teams_show(): void
    {
        $teams = Teams::factory()->create();

        $response = $this->get(route('teams.show', $teams->uuid));

        $this->assertJson($response->getContent());

        $response->assertStatus(200);
    }

    /**
     * TeamsTest: test_store
     * * php artisan test --filter=TeamsTest::test_teams_store
     */
    public function test_teams_store(): void
    {
        
        $payload = Teams::factory()->make()->toArray();

        $response = $this->post(route('teams.store'), $payload);

        $response->assertStatus(200);

    }

    /**
     * TeamsTest: test_store_validation
     * * php artisan test --filter=TeamsTest::test_teams_store_validation
     */
    public function test_teams_store_validation(): void
    {

        $response = $this->post(route('teams.store'), []);

        $response->assertStatus(302);
    }

    /**
     * TeamsTest: test_update
     * * php artisan test --filter=TeamsTest::test_teams_update
     */
    public function test_teams_update(): void
    {
        $teams = teams::factory()->create();

        $payload = Teams::factory()->make()->toArray();

        $response = $this->put(route('teams.update', $teams->uuid), $payload);

        $response->assertStatus(200);
    }

    /**
     * TeamsTest: test_destroy
     * * php artisan test --filter=TeamsTest::test_teams_destroy
     */
    public function test_teams_destroy(): void
    {
        $teams = Teams::factory()->create();

        $response = $this->delete(route('teams.destroy', $teams->uuid));

        $response->assertStatus(403);
    }
}
