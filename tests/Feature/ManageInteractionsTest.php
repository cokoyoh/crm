<?php

namespace Tests\Feature;

use CRM\Models\Lead;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\LeadFactory;
use Tests\TestCase;

class ManageInteractionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_interactions()
    {
        $lead = create(Lead::class);

        $this->post(route('interactions.store', $lead), [])
            ->assertRedirect('login');
    }

    /** @test */
    public function a_user_cannot_add_interactions_to_a_lead_which_is_not_assigned_to_them()
    {
        $jimMattis = UserFactory::fromCompany()->create();

        $lead = create(Lead::class);

        $this->actingAs($jimMattis)
            ->post(route('interactions.store', $lead), $input = ['body' => 'Some body'])
            ->assertStatus(403);
    }

    /** @test */
    public function the_interaction_body_is_required_when_adding_an_interaction()
    {

        $jimMattis = UserFactory::fromCompany()->create();

        $lead = LeadFactory::assignTo($jimMattis)->create();

        $this->actingAs($jimMattis)
            ->post(route('interactions.store', $lead), $input = ['body' => ''])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function user_id_is_required_when_adding_an_interaction()
    {
        $jimMattis = UserFactory::fromCompany()->create();

        $lead = LeadFactory::assignTo($jimMattis)->create();

        $this->actingAs($jimMattis)
            ->post(route('interactions.store', $lead), $input = ['user_id' => ''])
            ->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function authorised_users_can_add_an_interaction_to_a_lead()
    {
        $jimMattis = UserFactory::fromCompany()->create();

        $lead = $lead = LeadFactory::assignTo($jimMattis)->create();

        $this->actingAs($jimMattis)
            ->post(route('interactions.store', $lead), $input = ['body' => 'Some body', 'user_id' => $jimMattis->id])
            ->assertRedirect(route('leads.show', $lead));

        $this->assertDatabaseHas('interactions', $input);
    }
}
