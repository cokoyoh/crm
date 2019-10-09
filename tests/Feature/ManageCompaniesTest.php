<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageCompaniesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function invite_a_company_to_create_a_profile()
    {
        //a user who is the admin of the system adds  a user email

        //the email is sent to the user

        //the user clicks the link in th email

        //then they finish up the company profile

        //they can then start adding users in the system

        //assert that the link is sent
    }
}
