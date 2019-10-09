<?php

namespace Tests\Feature;

use CRM\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageCompaniesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function system_admin_can_invite_a_company_to_create_a_profile()
    {
        //a user of the system who has a role admin sends an invite to a company

        //a record is added in the system with the email of the invitee
    }
}
