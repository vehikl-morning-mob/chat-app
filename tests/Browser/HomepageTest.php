<?php

namespace Tests\Browser;

use App\Models\Message;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomepageTest extends DuskTestCase
{
    public function testExample()
    {
        $message = Message::factory()->create();
        // Make a few fake messages

        $this->browse(function (Browser $browser) use ($message) {
            $browser->visit('/')
                ->assertSee($message->content);
        });
    }
}
