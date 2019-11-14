<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\User;
use Facades\Tests\Setup\LeadFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class ConfirmLeadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_return_an_error_message_if_a_lead_email_exists_in_the_table_leads_from_users_of_the_same_company()
    {
        $safaricom = create(Company::class);

        $harryPotter = UserFactory::fromCompany($safaricom)->create();

        $lead = LeadFactory::fromCompany($safaricom)->assignTo($harryPotter)->create();

        $response = $this->actingAs($harryPotter)->get("/leads/check-email?email=$lead->email");

        $this->assertEquals(
            json_decode($response->content(), true)['message'],
            'A lead under the same email exists in the system and is currently assigned to ' . $harryPotter->name
        );
    }

    /** @test */
    public function it_returns_null_if_the_lead_email_that_exists_belong_to_a_different_company()
    {
        $safaricom = create(Company::class);

        $harryPotter = UserFactory::fromCompany($safaricom)->create();

        $johnReece = create(User::class);

        $lead = LeadFactory::assignTo($johnReece)->create();

        $response = $this->actingAs($harryPotter)->get("/leads/check-email?email=$lead->email");

        $this->assertEquals(json_decode($response->content(), true)['message'], null);
    }

    /** @test */
    public function it_return_an_error_message_if_a_lead_phone_exists_in_the_table_leads_from_users_of_the_same_company()
    {
        $this->withoutExceptionHandling();
        $lehmanBrothers = create(Company::class);

        $dickFuld = UserFactory::fromCompany($lehmanBrothers)->create();

        $lead = LeadFactory::fromCompany($lehmanBrothers)->assignTo($dickFuld)->create();

        $response = $this->actingAs($dickFuld)->get("/leads/check-phone?phone=$lead->phone");

        $this->assertEquals(
            json_decode($response->content(), true)['message'],
            'A lead under the same phone exists in the system and is currently assigned to ' . $dickFuld->name
        );
    }
}
