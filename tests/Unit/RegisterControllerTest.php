<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItRegistersAUser()
    {
        $user = [
            'name' => 'testName',
            'password' => 'fakePassword',
            'email' => 'fakeEmail@email.email',
        ];

        $this->postJson('/register', $user)->assertSuccessful();

        $this->assertNotEmpty(User::query()->where('email', $user['email'])->get());
    }

    public function testItDoesNotAllowAUserToRegisterWithAnExistingEmail()
    {
        $user = [
            'name' => 'testName',
            'email' => 'foo@bar.com',
            'password' => 'fakePassword',
        ];

        factory(User::class)->create(['email' => $user['email']]);

        $this
            ->postJson('/register', $user)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals(1, User::query()->where('email', $user['email'])->count());
    }

    public function testItAuthenticatesTheUserUponRegistration()
    {
        $registrationPayload = [
            'name' => 'testName',
            'email' => 'foo@bar.com',
            'password' => 'fakePassword',
        ];

        $this
            ->postJson('/register', $registrationPayload)
            ->assertSuccessful();

        /** @var $user User */
        $user = User::query()->where('email', $registrationPayload['email'])->first();

        $this->assertAuthenticatedAs($user);
    }

    public function testItHashesUsersPasswordUponRegistration()
    {
        $user = [
            'name' => 'testName',
            'email' => 'foo@bar.com',
            'password' => 'fakePassword',
        ];

        $this
            ->postJson('/register', $user)
            ->assertSuccessful();
        $this->assertTrue(Hash::check($user['password'],
            User::query()->where('email', $user['email'])->first()->password));
    }
}
