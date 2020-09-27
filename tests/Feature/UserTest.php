<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function confirm_user_was_created()
    {
        $user = User::factory()->make();

        $response = $this->postJson('/api/v1/users', [
            'name'  => $user->name,
            'email' => $user->email,
        ]);

        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function confirm_user_was_updated()
    {
        $user = User::factory()->create();

        $response = $this->putJson('/api/v1/users/' . $user->id, [
            'name'  => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ]);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function confirm_user_was_deleted()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson('/api/v1/users/' . $user->id);

        $response->assertStatus(200);
    }
}
