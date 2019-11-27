<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
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
}
