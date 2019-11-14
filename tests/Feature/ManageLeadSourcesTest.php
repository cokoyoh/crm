<?php

namespace Tests\Feature;

use CRM\Models\Company;
use Facades\Tests\Setup\LeadSourceFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageLeadSourcesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_lead_sources()
    {
        $this->post(route('lead-sources.store'), [])
            ->assertRedirect('login');
    }

    /** @test */
    public function only_admins_can_add_lead_sources()
    {
        $user = UserFactory::regularUser()->create();

        $this->actingAs($user)
            ->post(route('lead-sources.store'), [])
            ->assertForbidden();
    }

    /** @test */
    public function lead_source_name_is_required_when_adding_a_lead_source()
    {
        $user = UserFactory::admin()->create();

        $this->actingAs($user)
            ->post(route('lead-sources.store'), $attributes = ['name' => ''])
            ->assertSessionHasErrors('name');
    }


    /** @test */
    public function authorised_users_can_add_lead_sources()
    {
        $user = UserFactory::admin()->create();

        $this->actingAs($user)
            ->post(route('lead-sources.store'), $attributes = ['name' => 'Uhuru Park', 'slug' => 'uhuru-park'])
            ->assertRedirect(route('dashboard.user', $user));

        $this->assertDatabaseHas('lead_sources', $attributes);
    }

    /** @test */
    public function only_company_admins_can_view_lead_sources()
    {
        $company = create(Company::class);

        $user = UserFactory::fromCompany($company)->regularUser()->create();

        $this->actingAs($user)
            ->get(route('lead-sources.index'))
            ->assertForbidden();
    }

    /** @test */
    public function a_user_cannot_see_lead_sources_for_other_companies()
    {
        $company = create(Company::class);

        $user =  $user = UserFactory::fromCompany()->admin()->create();

        $leadSource = LeadSourceFactory::forCompany($company)->create();

        $this->actingAs($user)
            ->get(route('lead-sources.index'))
            ->assertDontSee($leadSource->name);
    }

    /** @test */
    public function authorised_users_can_view_lead_sources()
    {
        $company = create(Company::class);

        $user = UserFactory::fromCompany($company)->admin()->create();

        $leadSource = LeadSourceFactory::forCompany($company)->create();

        $this->actingAs($user)
            ->get(route('lead-sources.index'))
            ->assertSee($leadSource->name);
    }
}
