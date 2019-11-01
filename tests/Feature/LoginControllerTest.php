<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItLogsInAUser()
    {
        $this->withExceptionHandling();
        $user = factory(User::class)->create(
            [
                'password' => 'foobar',
            ]
        );

        $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'foobar',
        ])->assertSuccessful();

        $this->assertAuthenticatedAs($user);
    }
}
