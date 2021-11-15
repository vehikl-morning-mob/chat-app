<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_message()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $contentOfNewMessage = 'Hello World!';
        $this->actingAs($user);


        $this->postJson(route('messages.store'), ['content' => $contentOfNewMessage])
            ->assertSuccessful();

        $this->assertNotEmpty($user->messages);
        $this->assertEquals($contentOfNewMessage, $user->messages()->first()->content);
    }
}
