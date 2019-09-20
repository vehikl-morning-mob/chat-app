<?php

namespace Tests\Unit;

use App\User;
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

        $this->assertNotEmpty(User::query()->where('email', $user['email']));
    }
}
