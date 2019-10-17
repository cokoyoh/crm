<?php

namespace Tests\Unit;

use CRM\Models\Role;
use CRM\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_super_admin_role()
    {
        $jane = create(User::class);

        $john = create(User::class);

        $this->addRole($john, 'super_admin');

        $this->assertTrue($john->isSuperAdmin());

        $this->assertFalse($jane->isSuperAdmin());
    }

    /** @test */
    public function it_adds_a_role_to_a_user_instance_given_a_role_slug()
    {
        $user = create(User::class);

        create(Role::class, ['slug' => 'super_admin']);

        $this->assertEquals(0, $user->roles()->count());

        $user->addRole('super_admin');

        $this->assertEquals(1, $user->roles()->count());
    }

    /** @test */
    public function it_checks_if_a_user_has_a_particular_role()
    {
        $user = UserFactory::withRole('company_admin')->create();

        $this->assertTrue($user->hasRole('company_admin'));
    }

    /** @test */
    public function it_retrieves_the_full_name_of_a_user()
    {
        $user = create(User::class, ['first_name' => 'John', 'last_name' => 'Doe']);

        $this->assertEquals($user->fullname, 'John Doe');
    }
}
