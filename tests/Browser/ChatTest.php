<?php

namespace Tests\Browser;

use App\Models\Message;
use Illuminate\Support\Carbon;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ChatTest extends DuskTestCase
{
    public function test_it_shows_the_messages()
    {
        Carbon::setTestNow();

        $creationTime = now();
        $message = Message::factory()->create([
            'created_at' => $creationTime
        ]);
        // Make a few fake messages

        $this->browse(fn(Browser $browser) => $browser
            ->visit('/')
            ->assertSee($message->content)
            ->assertSee($creationTime->diffForHumans())
        );
    }
}
