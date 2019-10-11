<?php

namespace Tests\Feature;

use CRM\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function only_super_admins_can_send_company_invites()
    {
        $this->signIn();

        $this->get(route('companies.create'))->assertStatus(403);

        $this->post(route('companies.store'), raw(Company::class))
            ->assertStatus(403);
    }

    /** @test */
    public function system_admin_can_invite_a_company_to_create_a_profile()
    {
        $this->signInWithRole('super_admin');

        $this->get(route('companies.create'))->assertStatus(200);

        $attributes = [
            'name' => 'Example Inc',
            'email' => 'example@gmail.com'
        ];

        $this->post(route('companies.store'), $attributes);

        $this->assertEquals(1, Company::count());

        $this->assertEquals('example@gmail.com', Company::first()->email);
    }

    /** @test */
    public function a_company_requires_an_email_address()
    {
        $this->signInWithRole('super_admin');

        $attributes = ['name' => 'Example Inc', 'email' => ''];

        $this->post(route('companies.store'), $attributes)
            ->assertSessionHasErrors('email');
    }
}
