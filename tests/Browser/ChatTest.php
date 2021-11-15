<?php

namespace Tests\Browser;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChatTest extends DuskTestCase
{
    public function test_it_shows_the_messages()
    {
        Carbon::setTestNow();

        $creationTime = now();
        $user = User::factory()->has(Message::factory())->create();
        $message = $user->messages()->first();

        $this->browse(fn(Browser $browser) => $browser
            ->visit('/')
            ->assertSee($message->content)
            ->assertSee($creationTime->diffForHumans())
            //->assertSee($message->user->name)
        );
    }
}
