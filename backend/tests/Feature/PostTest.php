<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_post()
    {
        $topic = Topic::factory()->create();
        $resp =
            $this->actingAs($this->user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->postJson(
                '/api/topics/' . $topic->id . '/posts',
                [
                    "body" => "testsqx test",
                ]
            );
        $resp->assertStatus(201);
    }

    public function test_update_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->for($user)
            ->create();
        $topic = Topic::factory()->create();

        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->patchJson(
                '/api/topics/' . $topic->id . '/posts/' . $post->id,
                [
                    "body" => "test sqxqsxtest",
                ]
            )
            ->assertStatus(200);
    }

    public function test_delete_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->for($user)
            ->create();
        $topic = Topic::factory()->create();

        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->delete(
                '/api/topics/' . $topic->id . '/posts/' . $post->id,
            )
            ->assertStatus(204);
    }


    public function test_show_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->for($user)
            ->create();
        $topic = Topic::factory()->create();

        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->get(
                '/api/topics/' . $topic->id . '/posts/' . $post->id
            )
            ->assertStatus(200);
    }
}
