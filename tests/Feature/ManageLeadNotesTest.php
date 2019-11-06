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
    public function guests_cannot_add_notes()
    {
        $lead = LeadFactory::assignTo(create(User::class))->create();

        $this->post(route('leads.notes.store', $lead), [])
            ->assertRedirect('login');
    }

    /** @test */
    public function a_user_cannot_add_a_note_to_a_lead_they_do_not_own()
    {
        $albusDumbledore = create(User::class);

        $lead = LeadFactory::assignTo(create(User::class))->create();

        $this->actingAs($albusDumbledore)
            ->post(route('leads.notes.store', $lead), [])
            ->assertStatus(403);
    }

    /** @test */
    public function authorised_users_can_add_notes_to_a_lead_they_own()
    {
        $ritaSkeeta = create(User::class);

        $lead = LeadFactory::assignTo($ritaSkeeta)->create();

        $this->actingAs($ritaSkeeta)
            ->post(route('leads.notes.store', $lead), $input = ['body' => 'Some hocus pocus notes'])
            ->assertRedirect(route('leads.show', $lead));

        $this->assertDatabaseHas('lead_notes', $input);
    }
}
