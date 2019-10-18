<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\Role;
use CRM\Models\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InviteUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthorised_users_who_are_not_company_admins_cannot_invite_other_users()
    {
        $company = create(Company::class);

        $this->actingAs(create(User::class))
            ->post(route('users.invite', $company), [])
            ->assertStatus(403);
    }

    /** @test */
    public function the_link_to_update_profile_can_only_be_used_once()
    {
        $goldmanSachs = create(Company::class);

        $user = create(User::class, ['email_verified_at' => null])->addToCompany($goldmanSachs);

        $this->actingAs($user)
            ->get(route('users.profile', $goldmanSachs))
            ->assertStatus(403);
    }

    /** @test */
    public function company_admin_can_invite_other_users()
    {
        create(Role::class, ['slug' => 'user']);

        $company = create(Company::class);

        $companyAdmin = UserFactory::fromCompany($company)->withRole('company_admin')->create();

        $attributes = [
            'email' => 'john@example.com',
            'name' => 'John Doe'
        ];

        $this->actingAs($companyAdmin)
            ->post(route('users.invite', $company), $attributes)
            ->assertRedirect(route('companies.show', $company->id));

        $this->assertDatabaseHas('users', ['email' => $attributes['email']]);

        $this->assertCount(2, $company->users);
    }

    /** @test */
    public function email_is_required_when_inviting_a_user()
    {
        $company = create(Company::class);

        $companyAdmin = UserFactory::fromCompany($company)->withRole('company_admin')->create();

        $this->actingAs($companyAdmin)
            ->post(route('users.invite', $company), ['email' => ''])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_name_is_required_when_inviting_a_user()
    {
        $company = create(Company::class);

        $companyAdmin = UserFactory::fromCompany($company)->withRole('company_admin')->create();

        $this->actingAs($companyAdmin)
            ->post(route('users.invite', $company), ['name' => ''])
            ->assertSessionHasErrors('name');
    }
}
