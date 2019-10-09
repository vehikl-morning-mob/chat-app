<?php

namespace Tests\Unit;

use App\User;
use App\Message;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItAllowsUserToGetAllExistingMessages()
    {
        $existingMessages = factory(Message::class, 5)->create();

        $expectedMessages = [
            'messages' => $existingMessages->pluck('content')->toArray(),
        ];

        $this->getJson(route('messages.index'))
            ->assertSuccessful()
            ->assertExactJson($expectedMessages);
    }
}
