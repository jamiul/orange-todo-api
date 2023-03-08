<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    // guest can create an account
    public function test_guest_can_register()
    {
        $this->postJson(route('user.register'), [
            'name' => "Sarthak",
            'email' => 'sarthak@bitfumes.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ])->assertCreated();

        $this->assertDatabaseHas('users', ['name' => 'Sarthak']);
    }
}
