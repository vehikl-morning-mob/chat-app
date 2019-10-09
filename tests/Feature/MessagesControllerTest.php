<?php

namespace Tests\Unit;

use App\User;
use App\Message;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItAllowsUserToGetAllExistingMessages()
    {
        [$firstMessage, $secondMessage] = factory(Message::class, 2)->create();

        $expectedResponse = [
            [
                'user' => $firstMessage->user->name,
                'message' => $firstMessage->content,
            ],
            [
                'user' => $secondMessage->user->name,
                'message' => $secondMessage->content,
            ],
        ];

        $this->getJson(route('messages.index'))
            ->assertSuccessful()
            ->assertExactJson($expectedResponse);
    }

    public function testItAllowsUserToPostAMessage()
    {
        $user = factory(User::class)->create();

        $message = 'a message';
        $this->actingAs($user)
            ->postJson(route('messages.store'), ['message' => $message])
            ->assertExactJson(['message' => $message]);
    }
}
