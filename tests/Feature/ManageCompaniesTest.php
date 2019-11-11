<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\Role;
use CRM\Models\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ManageCompaniesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_companies()
    {
        $this->get(route('companies.index'))->assertRedirect('login');

        $this->post(route('companies.store'), raw(Company::class))->assertRedirect('login');
    }

    /** @test */
    public function only_company_admins_and_super_admins_can_manage_companies()
    {
        $company = create(Company::class);

        $superAdmin = UserFactory::superAdmin()->create();

        $john = UserFactory::fromCompany($company)->admin()->create();

        $jane = UserFactory::withRole('user')->create();

        $this->actingAs($superAdmin)->get(route('companies.show', $company->id))->assertStatus(200);

        $this->actingAs($john)->get(route('companies.show', $company->id))->assertStatus(200);

        $this->actingAs($jane)->get(route('companies.show', $company->id))->assertStatus(403);
    }

    /** @test */
    public function only_super_admins_can_send_company_invites()
    {
        $superAdmin = UserFactory::superAdmin()->create();

        $this->actingAs($superAdmin)->get(route('companies.create'))->assertStatus(200);

        $this->actingAs(create(User::class))->get(route('companies.create'))->assertStatus(403);

        $this->post(route('companies.store'), raw(Company::class))
            ->assertStatus(403);
    }

    /** @test */
    public function system_admin_can_invite_a_company_to_create_a_profile()
    {
        $this->signInWithRole('super_admin');

        $this->get(route('companies.create'))->assertStatus(200);

        $this->post(route('companies.store'), ['name' => 'Example Inc', 'email' => 'example@gmail.com']);

        $this->assertEquals(1, Company::count());

        $this->assertEquals('example@gmail.com', Company::latest()->first()->email);
    }

    /** @test */
    public function a_company_requires_an_email_address()
    {
        $this->signInWithRole('super_admin');

        $attributes = ['name' => 'Example Inc', 'email' => ''];

        $this->post(route('companies.store'), $attributes)
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_user_can_complete_a_company_profile()
    {
        create(Role::class, ['slug' => 'admin']);

        $company = create(Company::class);

        $data = rawState(User::class, [], 'raw') + ['company_name' => $company->name, 'company_email' => $company->email];

        tap($company, function ($company) use ($data) {
            $this->post(route('companies.profiles.store', $company->id), $data)->assertRedirect(route('login'));

            $this->assertDatabaseHas('users', ['email' => $data['email']]);
        });

        tap($company->fresh(), function ($company) use($data) {
            $this->assertEquals($company->email, $data['company_email']);

            $this->assertNotNull($company->register_token);

            $this->assertNotNull($company->confirmed_at);

            $this->assertTrue(User::first()->isAdmin());
        });
    }

    /** @test */
    public function admin_email_is_required()
    {
        $data = raw(User::class, ['email' => '']);

        $company = create(Company::class);

        $this->post(route('companies.profiles.store', $company->id), $data)
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function admin_password_is_required()
    {
        $data = rawState(User::class, ['password' => ''], 'raw');

        $company = create(Company::class);

        $this->post(route('companies.profiles.store', $company->id), $data)
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function admin_name_is_required()
    {
        $data = rawState(User::class, ['name' => ''], 'raw');

        $company = create(Company::class);

        $this->post(route('companies.profiles.store', $company->id), $data)
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function complete_company_profile_link_can_only_be_used_once()
    {
        $company = create(Company::class, ['register_token' => Str::random(10), 'confirmed_at' => now()]);

        $this->post(route('companies.profiles.store', $company->id), [])
            ->assertStatus(403);
    }
}
