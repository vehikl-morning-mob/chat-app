<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItRespondsWithJWTOnSuccessfulLogin()
    {
        $user = factory(User::class)->create(['password' => '123password']);
        $response = $this->postJson(route('api.login'), ['email' => $user->email, 'password' => '123password'])
            ->assertSuccessful();

        $this->assertNotEmpty($response->json('access_token'));
    }

    public function testItRespondsWithErrorMessageOnInvalidLogin()
    {
        $user = factory(User::class)->create(['password' => '123password']);
        $response = $this->postJson(route('api.login'), ['email' => $user->email, 'password' => 'wrongpassword'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertNotEmpty($response->json('message'));
    }

    public function testItRespondsWithNewTokenOnRefresh()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();  // Creating fake user
        $oldToken = auth('api')->login($user);  // Pretend that user has already logged in

        $response = $this->postJson(route('api.refresh'), [], ['Authorization' => "bearer $oldToken"])
            ->assertSuccessful();

        $tokenThatWeGotBack = $response->json('access_token');
        $this->assertNotEquals($tokenThatWeGotBack, $oldToken);
    }
}
