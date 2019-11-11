<?php

namespace Tests\Feature;

use CRM\Models\Company;
use Facades\Tests\Setup\LeadFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class ConfirmLeadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_confirms_if_a_lead_already_exists_in_the_table_leads_given_an_email()
    {
        $safaricom = create(Company::class);

        $harryPotter = UserFactory::fromCompany($safaricom)->create();

        $lead = LeadFactory::assignTo($harryPotter)->create();

        $response = $this->actingAs($harryPotter)->get("/leads/check-email?email=$lead->email");

        $this->assertEquals(
            json_decode($response->content(), true)['message'],
            'A lead under the same email exists in the system and is currently assigned to ' . $harryPotter->name
        );
    }
}
