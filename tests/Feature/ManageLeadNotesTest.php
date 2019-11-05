<?php

namespace Tests\Feature;

use CRM\Models\User;
use Facades\Tests\Setup\LeadFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageLeadNotesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorised_users_can_add_notes_to_a_lead()
    {
        $ritaSkeeta = create(User::class);

        $lead = LeadFactory::assignTo($ritaSkeeta)->create();

        $this->actingAs($ritaSkeeta)
            ->post(route('leads.notes.store', $lead), $input = ['body' => 'Some hocus pocus notes'])
            ->assertRedirect(route('leads.show', $lead));

        $this->assertDatabaseHas('lead_notes', $input);
    }
}
