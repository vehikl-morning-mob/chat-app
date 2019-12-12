<?php

namespace Tests\Unit;

use Event;
use App\User;
use App\Message;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use App\Events\NewMessageReceived;
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

    public function testItAllowsUserToGetAllExistingMessagesViaPublicApi()
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

        $this->getJson(route('api.messages.index'))
            ->assertSuccessful()
            ->assertExactJson($expectedResponse);
    }

    public function testItAllowsUserToPostAMessage()
    {
        $user = factory(User::class)->create();

        $message = 'a message';
        $this->actingAs($user)
            ->postJson(route('messages.store'), ['content' => $message])
            ->assertExactJson(['message' => $message]);
    }

    public function testItAllowsUserToPostAMessageViaPublicApi()
    {
        $user = factory(User::class)->create();

        $message = 'a message';
        $this->actingAs($user)
            ->postJson(route('api.messages.store'), ['content' => $message])
            ->assertExactJson(['message' => $message]);

        $this->assertNotEmpty(Message::query()->where('content', $message));
    }

    public function testItPreventsMessagesFromBeingCreatedWithoutContent()
    {
        $user = factory(User::class)->create();

        $message = 'a message';
        $this->actingAs($user)
            ->postJson(route('messages.store'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testItBroadcastsNewMessageReceivedWhenANewMessageIsCreated()
    {
        Event::fake();
        $user = factory(User::class)->create();

        $message = 'a message';
        $this->actingAs($user)
            ->postJson(route('messages.store'), ['content' => $message])
            ->assertExactJson(['message' => $message]);

        Event::assertDispatched(NewMessageReceived::class, function ($event) use ($message, $user) {
            return $event->message === $message;
        });
    }


}
