<?php

namespace Tests\Feature;

use CRM\Models\Lead;
use CRM\Models\LeadClass;
use CRM\Models\User;
use Facades\Tests\Setup\LeadFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ManageLeadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_leads()
    {
        $attributes = rawState(Lead::class);

        $lead = create(Lead::class);

        $this->post(route('leads.store'), $attributes)
            ->assertRedirect(route('login'));

        $this->get(route('leads.show', $lead))
            ->assertRedirect('login');
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

        $leadClass = create(LeadClass::class, ['slug' => 'not_followed_up']);

        $this->actingAs($user)
            ->post(route('leads.store'), $attributes)
            ->assertStatus(302);

        $this->assertEquals(1, Lead::count());

        $this->assertEquals($user->id, Lead::first()->leadAssignee->user_id);

        $this->assertEquals(Lead::first()->lead_class_id, $leadClass->id);
    }

    /** @test */
    public function a_user_cannot_see_details_of_a_lead_which_is_not_assigned_to_them()
    {
        $lead = create(Lead::class);

        $this->actingAs(create(User::class))
            ->get(route('leads.show', $lead))
            ->assertStatus(403);
    }

    /** @test */
    public function authorised_users_can_see_details_of_their_lead()
    {
        $user = create(User::class);

        $lead = LeadFactory::assignTo($user)->withClass('lost')->create();

        $this->actingAs($user)
            ->get(route('leads.show', $lead))
            ->assertSee($lead->name)
            ->assertSee($lead->email);
    }

    /** @test */
    public function a_user_cannot_mark_a_lead_which_they_do_not_own_as_lost()
    {
        $user = create(User::class);

        $lead = LeadFactory::assignTo(create(User::class))->create();

        $this->actingAs($user)
            ->get(route('leads.lost', $lead))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_users_can_mark_a_lead_as_lost()
    {
        $johnDoe = create(User::class);

        $lead = LeadFactory::assignTo($johnDoe)->withClass('followed_up')->create();

        create(LeadClass::class, ['slug' => 'lost']);

        $this->actingAs($johnDoe)
            ->get(route('leads.lost', $lead))
            ->assertRedirect(route('leads.show', $lead));

        $this->assertEquals($lead->fresh()->leadClass->slug, 'lost');
    }
}
