<?php

namespace Tests\Unit;

use CRM\Models\Contact;
use CRM\Models\ContactUser;
use CRM\Models\Lead;
use CRM\Models\User;
use Facades\Tests\Setup\ContactFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_associated_with_contact_user_model()
    {
        $contact = ContactFactory::assignTo(create(User::class))->create();

        $this->assertInstanceOf(ContactUser::class, $contact->contactUser);
    }

    /** @test */
    public function a_contact_has_a_lead()
    {
        $lead = create(Lead::class);

        $contact = ContactFactory::associatedWith($lead)->create();

        $this->assertInstanceOf(Lead::class, $contact->lead);
    }
}
