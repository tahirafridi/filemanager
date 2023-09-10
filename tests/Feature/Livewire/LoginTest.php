<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Admin\Pages\DashboardLivewire;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Auth\Pages\Login;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login(): void
    {
        $loginComponent = Login::class;

        //  check if login page component loads
        Livewire::test($loginComponent)->assertStatus(200);

        $name = 'Tahir Afridi';
        $email = 'tahir@example.com';
        $password = 'password';

        //  create a user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        //  check if user created with email
        $this->assertEquals($email, $user->email);

        //  set public properties and call login method
        Livewire::test($loginComponent)
            ->set('email', $email)
            ->set('password', bcrypt($password))
            ->call('login');

        //  logged in as a user
        $this->actingAs($user);

        //  check after login user can access dashboard page component
        Livewire::test(DashboardLivewire::class)->assertStatus(200);
    }
}
