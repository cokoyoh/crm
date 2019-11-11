<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\Role;
use CRM\Models\RoleUser;
use CRM\Models\User;
use Facades\Tests\Setup\UserFactory;
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

    /** @test */
    public function only_company_admin_can_delete_a_user_account()
    {
        $andela = create(Company::class);

        $janeDoe = UserFactory::fromCompany($andela)->regularUser()->create();

        $johnDoe = UserFactory::fromCompany($andela)->regularUser()->create();

        $this->actingAs($janeDoe)
            ->delete(route('users.destroy', $johnDoe))
            ->assertStatus(403);
    }

    /** @test */
    public function a_company_admin_can_only_delete_user_accounts_from_the_same_company()
    {
        $admin = UserFactory::fromCompany(create(Company::class))->admin()->create();

        $johnDoe = UserFactory::fromCompany(create(Company::class))->regularUser()->create();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $johnDoe))
            ->assertStatus(403);
    }


    /** @test */
    public function a_company_admin_cannot_delete_their_own_account()
    {
        $admin = UserFactory::fromCompany(create(Company::class))->admin()->create();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $admin))
            ->assertStatus(403);
    }

    /** @test */
    public function a_company_admin_can_delete_a_user_account()
    {
        $andela = create(Company::class);

        $admin = UserFactory::fromCompany($andela)->admin()->create();

        $johnDoe = UserFactory::fromCompany($andela)->regularUser()->create();

        $this->actingAs($admin)
            ->delete(route('users.destroy', $johnDoe))
            ->assertRedirect(route('companies.show', $andela));

        $this->assertNotNull($johnDoe->fresh()->deleted_at);
    }
}
