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
        $user = factory(User::class)->create();

        $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => 'foobar',
        ])->dump();

        $this->assertAuthenticatedAs($user);
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

    /**
     * @dataProvider providesInvalidUserPayloads
     * @param $invalidPayload
     * @param $invalidAttributeName
     */
    public function testItDoesNotRegisterUsersWithInvalidInfo($invalidPayload, $invalidAttributeName)
    {
        $this->postJson('/register', $invalidPayload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'errors' => [$invalidAttributeName],
            ]);
    }

    public function providesInvalidUserPayloads()
    {
        $validEmail = 'proper@email.com';
        $validPassword = 'password413!';
        $validName = 'Foobar Buzzfizz';
        return [
            'Invalid name' => [
                [
                    'name' => '',
                    'email' => $validEmail,
                    'password' => $validPassword,
                ],
                'name',
            ],
            'Missing Email' => [
                [
                    'name' => $validName,
                    'password' => $validPassword,
                ],
                'email',
            ],
        ];
    }
}
