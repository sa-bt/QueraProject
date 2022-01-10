<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiSampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_comment_api()
    {
        $this->actingAs($user = User::factory()->create());
        $post = Post::factory()->for($user)->create();

        $response = $this->postJson('/api/comments', [
            'text' => 'test',
            'commentable_id' => $post->id,
            'commentable_type' => 'App\Models\Post'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('comments', [
            'text' => 'test'
        ]);
    }
}
