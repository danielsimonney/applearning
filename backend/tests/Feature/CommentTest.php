<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Store_Comment()
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->create();
        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->postJson(
                '/api/comments/topic/' . $topic->id,
                [
                    "body" => "test test",
                ]
            )
            ->assertStatus(200);
    }

    public function test_bad_type_Store_Comment()
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->create();
        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->postJson(
                '/api/comments/nlnl/' . $topic->id,
                [
                    "body" => "test test",
                ]
            )
            ->assertStatus(404);
    }

    public function test_bad_id_Store_Comment()
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->create();
        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->postJson(
                '/api/comments/nlnl/' . -1,
                [
                    "body" => "test test",
                ]
            )
            ->assertStatus(401);
    }
    public function test_bad_delete_comment()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $topic = Topic::factory()->create();
        $comment = Comment::factory()->for($user2)->for(
            $topic,
            'commentable'
        )->create();


        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->delete(
                '/api/comments/' . $comment->id,
            )
            ->assertStatus(403);
    }

    public function test_good_comment_owner_delete_comment()
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->create();
        $comment = Comment::factory()->for($user)->for(
            $topic,
            'commentable'
        )->create();


        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->delete(
                '/api/comments/' . $comment->id,
            )
            ->assertStatus(204);
    }

    public function test_good_topic_owner_delete_comment()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $topic = Topic::factory()->for($user)->create();
        $comment = Comment::factory()->for($user2)->for(
            $topic,
            'commentable'
        )->create();

        $res =
            $this->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->delete(
                '/api/comments/' . $comment->id,
            )
            ->assertStatus(204);
    }

    public function test_good_post_owner_delete_comment()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->for($user)
            ->create();
        $user2 = User::factory()->create();
        $comment = Comment::factory()->for($user2)->for(
            $post,
            'commentable'
        )->create();


        $res =
            $this->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->delete(
                '/api/comments/' . $comment->id,
            )
            ->assertStatus(204);
    }
}
