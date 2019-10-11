<?php

namespace Tests\Feature;

use CRM\Models\Role;
use CRM\Models\RoleUser;
use CRM\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function all_registered_users_are_given_a_role_of_user_during_registration()
    {
        $user = raw(User::class, [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        create(Role::class, ['slug' => 'user']);

        $this->post(route('register'), $user);

        $this->assertCount(1, User::all());

        $this->assertCount(1, RoleUser::all());

        $this->assertEquals('user', RoleUser::first()->role->slug);
    }
}
