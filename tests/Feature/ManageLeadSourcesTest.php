<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\Lead;
use CRM\Models\LeadSource;
use Facades\Tests\Setup\LeadSourceFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageLeadSourcesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_lead_sources()
    {
        $leadSource = create(LeadSource::class);

        $this->post(route('lead-sources.store'), [])
            ->assertRedirect('login');

        $this->delete(route('lead-sources.destroy', $leadSource->id))
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
            ->post(route('lead-sources.store'), $attributes = ['name' => 'Uhuru Park'])
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
    public function only_admins_can_delete_lead_sources()
    {
        $deanThomas = UserFactory::regularUser()->create();

        $leadSource = create(LeadSource::class);

        $this->actingAs($deanThomas)
            ->delete(route('lead-sources.destroy', $leadSource))
            ->assertForbidden();
    }

    /** @test */
    public function an_admin_cannot_delete_lead_sources_from_other_companies()
    {
        $hogwartsExpress = create(Company::class);

        $deanThomas = UserFactory::fromCompany(create(Company::class))->admin()->create();

        $leadSource = LeadSourceFactory::forCompany($hogwartsExpress)->create();

        $this->actingAs($deanThomas)
            ->delete(route('lead-sources.destroy', $leadSource->id))
            ->assertForbidden();
    }

    /** @test */
    public function a_lead_source_with_leads_cannot_be_deleted()
    {
        $hogwartsExpress = create(Company::class);

        $deanThomas = UserFactory::fromCompany($hogwartsExpress)->admin()->create();

        $leadSource = LeadSourceFactory::forCompany($hogwartsExpress)->create();

        $lead = create(Lead::class, ['lead_source_id' => $leadSource->id]);

        $this->actingAs($deanThomas)
            ->delete(route('lead-sources.destroy', $leadSource->id))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_users_can_delete_lead_sources()
    {
        $hogwartsExpress = create(Company::class);

        $deanThomas = UserFactory::fromCompany($hogwartsExpress)->admin()->create();

        $leadSource = LeadSourceFactory::forCompany($hogwartsExpress)->create();

        $this->actingAs($deanThomas)
            ->delete(route('lead-sources.destroy', $leadSource->id))
            ->assertRedirect();

        $this->assertNotNull($leadSource->fresh()->deleted_at);
    }
}
