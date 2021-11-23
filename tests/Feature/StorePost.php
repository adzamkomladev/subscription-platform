<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class StorePost extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_create_post_successfully()
    {
        $website = Website::factory()->create();

        $post = Post::factory()->state([
            'website_id' => $website->id,
        ])->make();

        $body = [
            'website_id' => $website->id,
            'title' => $post->title,
            'description' => $post->description,
        ];

        $response = $this->post(route('posts.store'), $body);

        $response->assertJson($body);
        $response->assertStatus(Response::HTTP_CREATED);
    }
}
