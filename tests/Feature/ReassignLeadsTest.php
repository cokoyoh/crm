<?php

namespace Tests\Feature;

use CRM\Models\Company;
use Facades\Tests\Setup\ContactFactory;
use Facades\Tests\Setup\LeadFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReassignLeadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_company_admins_can_reassign_leads()
    {
        $company = create(Company::class);

        $user = UserFactory::fromCompany($company)->regularUser()->create();

        $lead = LeadFactory::fromCompany($company)->create();

        $this->actingAs($user)
            ->post(route('leads.reassign', $lead), [])
            ->assertForbidden();
    }

    /** @test */
    public function only_admins_of_the_same_company_can_reassign_company_leads()
    {
        $company = create(Company::class);

        $user = UserFactory::fromCompany(create(Company::class))->admin()->create();

        $lead = LeadFactory::fromCompany($company)->create();

        $this->actingAs($user)
            ->post(route('leads.reassign', $lead), [])
            ->assertForbidden();
    }

    /** @test */
    public function a_lead_that_has_been_converted_cannot_be_reassigned()
    {
        $company = create(Company::class);

        $user = UserFactory::fromCompany($company)->admin()->create();

        $lead = LeadFactory::fromCompany($company)->withClass('converted')->create();

        ContactFactory::associatedWith($lead)->create();

        $this->actingAs($user)
            ->post(route('leads.reassign', $lead), [])
            ->assertForbidden();
    }

    /** @test */
    public function authorised_users_can_reassign_leads()
    {
        $company = create(Company::class);

        $admin = UserFactory::fromCompany($company)->admin()->create();

        $oliverWood = UserFactory::fromCompany($company)->regularUser()->create();

        $aliciaSpinet = UserFactory::fromCompany($company)->regularUser()->create();

        $lead = LeadFactory::fromCompany($company)->assignTo($oliverWood)->create();

        $this->actingAs($admin)
            ->post(route('leads.reassign', $lead), ['user_id' => $aliciaSpinet->id]);

        $this->assertTrue($lead->isAssigned($aliciaSpinet));
    }
}
