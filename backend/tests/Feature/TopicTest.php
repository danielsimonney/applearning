<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\User;
use App\Models\Topic;
use SebastianBergmann\Type\ObjectType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicTest extends TestCase
{

    /**
     * The user
     *
     * @var \App\Models\User
     */
    protected $user;

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
    public function test_store_topic()
    {
        $user = User::factory()->create();
        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->postJson(
                '/api/topics',
                [
                    "body" => "test test",
                    "title" => "test test",
                ]
            )
            ->assertStatus(201);
    }

    public function test_store_topic_with_tags()
    {
        $user = User::factory()->create();

        $tags = Tag::factory()->count(3)->create()->pluck('id')->toArray();

        $resp =
            $this->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->postJson(
                '/api/topics',
                [
                    "body" => "test test",
                    "title" => "test test",
                    "tags" => $tags
                ]
            );
        $resp->assertStatus(201);
        // dump("hi");
        // dump($resp);
    }

    public function test_store_topic_with_unexisted_tags()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->postJson(
                '/api/topics',
                [
                    "body" => "test test",
                    "title" => "test test",
                    "tags" => [-1]
                ]
            )
            ->assertStatus(422);
    }


    public function test_store_topic_validation_fail_empty()
    {
        $user = User::factory()->create();

        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->actingAs($user)
            ->postJson('api/topics');

        $response->assertStatus(422);
    }

    public function test_store_topic_validation_fail_bad_title()
    {
        $user = User::factory()->create();

        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->actingAs($user)
            ->postJson(
                'api/topics',
                [
                    "body" => "test test",
                    "title" => "testberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebv test",
                ]
            );

        $response->assertStatus(422);
    }


    public function test_store_topic_validation_fail_bad_body()
    {
        $user = User::factory()->create();

        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->actingAs($user)
            ->postJson(
                'api/topics',
                [
                    "body" => "test teberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebvberbsresbreqsbdvresbresbreqbssertbsretloremsdlfjkhbqiuvylrebv",
                    "title" => "test test",
                ]
            );

        $response->assertStatus(422);
    }

    public function test_get_topics()
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->get('/api/topics')
            ->assertStatus(200);
    }

    public function test_show_topics()
    {

        $user = User::factory()->create();

        $topic = Topic::factory()
            ->hasUser()
            ->hasPosts(3)
            ->create();

        $resp =
            $this->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->get(
                '/api/topics/' . $topic->id
            )->assertStatus(200);

        // $resp->dump();

        assert($resp->getData()->data->id == $topic->id);
    }

    public function test_update_other_people_topics()
    {
        $user = User::factory()->create();
        $topic = Topic::factory()->create();
        $resp =
            $this->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->patchJson(
                '/api/topics/' . $topic->id,
                ["title" => "qsko,vosd,vmlmlls;",]
            )->assertStatus(403);
    }

    public function test_update_topics()
    {
        $updateString = "an updated test for my topic";

        $user = User::factory()->create();

        $topic = Topic::factory()
            ->for($user)
            ->hasPosts(3)
            ->create();

        $resp =
            $this->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->patchJson(
                '/api/topics/' . $topic->id,
                ["title" => $updateString]
            )->assertStatus(200);

        // $verifResp = $this->actingAs($user)
        //     ->withHeaders([
        //         'Content-Type' => 'application/json',
        //         'Accept' => 'application/json',
        //     ])
        //     ->get(
        //         '/api/topics/' . $topic->id
        //     )->assertStatus(200);

        assert($resp->getData()->data->title == $updateString);

        // $resp->dump();
    }

    public function test_delete_topic()
    {
        $user = User::factory()->create();
        $topic = Topic::factory()
            ->for($user)
            ->create();

        $resp =
            $this->actingAs($user)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
            ->delete(
                '/api/topics/' . $topic->id,
            )->assertStatus(204);
    }
}
