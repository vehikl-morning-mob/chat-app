<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebAuthController extends TestCase
{
    use RefreshDatabase;

    public function testItLogsInAUser()
    {
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

    public function testItProvidesErrorMessagesWhenLoginFails()
    {
        $user = factory(User::class)->create(
            [
                'password' => 'foobar',
            ]
        );

        $this
            ->postJson(route('login'), [
                'email' => $user->email,
                'password' => 'nottherightpassword',
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertExactJson([
                'errors' => [],
                'message' => 'The credentials provided are invalid',
            ]);
    }
}
