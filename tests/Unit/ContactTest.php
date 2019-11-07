<?php

namespace Tests\Unit;

use CRM\Models\ContactUser;
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
}
