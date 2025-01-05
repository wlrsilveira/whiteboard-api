<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Models\Whiteboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhiteboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_whiteboard(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/whiteboards', [
            'name' => 'new board',
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'name', 'identifier']]);
    }

    public function test_update_whiteboard(): void
    {
        $whiteboard = Whiteboard::factory()->create();
        $user = $whiteboard->user;
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->putJson("/api/whiteboards/$whiteboard->id", [
            'name' => 'new board',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'name', 'identifier']]);
    }

    public function test_delete_whiteboard(): void
    {
        $whiteboard = Whiteboard::factory()->create();
        $user = $whiteboard->user;
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->delete("/api/whiteboards/$whiteboard->id");

        $response->assertStatus(204);
    }

    public function test_show_qr_code(): void
    {
        $whiteboard = Whiteboard::factory()->create();
        $user = $whiteboard->user;
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->get("/api/whiteboards/$whiteboard->id/qrcode");

        $response->assertStatus(200);
    }

    public function test_user_cannot_update_other_users_whiteboard(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $whiteboard = Whiteboard::factory()->create(['user_id' => $anotherUser->id]);

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->putJson("/api/whiteboards/{$whiteboard->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(403);
    }
}
