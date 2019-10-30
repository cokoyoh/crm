<?php

namespace Tests\Feature;

use CRM\Models\Lead;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageLeadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_leads()
    {
        $attributes = rawState(Lead::class);

        $this->post(route('leads.store'), $attributes)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function either_phone_number_or_email_is_required_when_adding_a_new_lead()
    {
        $this->signIn();

        $attributes = rawState(Lead::class, ['email' => '', 'phone_number' => '']);

        $this->post(route('leads.store'), $attributes)
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function country_code_is_required_if_email_is_empty_when_adding_a_lead()
    {
        $this->signIn();

        $attributes = rawState(Lead::class, ['country_code' => '', 'email' => '']);

        $this->post(route('leads.store'), $attributes)
            ->assertSessionHasErrors('country_code');
    }

    /** @test */
    public function email_address_must_be_unique_when_adding_a_lead()
    {
        $this->signIn();

        $lead = create(Lead::class);

        $this->post(route('leads.store'), $lead->toArray())
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function authorised_users_can_add_leads()
    {
        $user = UserFactory::withRole('user')->create();

        $attributes = rawState(Lead::class);

        $this->actingAs($user)
            ->post(route('leads.store'), $attributes)
            ->assertRedirect(route('dashboard.user', $user));

        $this->assertEquals(1, Lead::count());

        $this->assertEquals($user->id, Lead::first()->leadAssignee->user_id);
    }
}
