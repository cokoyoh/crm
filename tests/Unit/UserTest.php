<?php

namespace Tests\Unit;

use CRM\Models\Company;
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

        $this->assertEquals($user->name, 'John Doe');
    }

    /** @test */
    public function it_can_be_added_to_a_company()
    {
        $company = create(Company::class);

        $user = create(User::class)->addToCompany($company);

        $companyUsers = $company->fresh()->users;

        $this->assertCount(1, $companyUsers);

        $this->assertTrue($companyUsers->contains($user));
    }

    /** @test */
    public function a_user_is_associated_with_a_company()
    {
        $company = create(Company::class);

        $user = UserFactory::fromCompany($company)->create();

        $this->assertInstanceOf(Company::class, $user->company);
    }

    /** @test */
    public function it_gets_the_status_of_a_user()
    {
        $borisJohnson = create(User::class);

        $this->assertEquals($borisJohnson->status, 'Active');
    }

    /** @test */
    public function it_checks_if_user_has_role_admin()
    {
        $nancyPeloci = UserFactory::withRole('admin')->create();

        $mikePence = UserFactory::withRole('user')->create();

        $this->assertTrue($nancyPeloci->isAdmin());

        $this->assertFalse($mikePence->isAdmin());
    }

    /** @test */
    public function it_retrieves_only_active_users()
    {
        $activeUser = create(User::class);

        $deactivatedUser = create(User::class, ['deactivated_at' => now()->subWeeks(1)]);

        $users = User::active()->get();

        $this->assertCount(1, $users);

        $this->assertTrue($users->contains($activeUser));

        $this->assertFalse($users->contains($deactivatedUser));
    }
}
