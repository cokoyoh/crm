<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\Contact;
use CRM\Models\Lead;
use CRM\Models\LeadClass;
use CRM\Models\LeadSource;
use CRM\Models\User;
use Facades\Tests\Setup\LeadFactory;
use Facades\Tests\Setup\LeadSourceFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ContactFactory;
use Tests\TestCase;

class ManageLeadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_leads()
    {
        $attributes = rawState(Lead::class);

        $lead = create(Lead::class);

        $this->get(route('leads.create'))
            ->assertRedirect('login');

        $this->post(route('leads.store'), $attributes)
            ->assertRedirect(route('login'));

        $this->get(route('leads.show', $lead))
            ->assertRedirect('login');
    }

    /** @test */
    public function either_phone_number_or_email_is_required_when_adding_a_new_lead()
    {
        $this->signIn();

        $attributes = rawState(Lead::class, ['email' => '', 'phone' => '']);

        $this->post(route('leads.store'), $attributes)
            ->assertSessionHasErrors('email');
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
    public function a_lead_must_have_a_source()
    {
        $luddoBagman = UserFactory::regularUser()->create();

        $this->actingAs($luddoBagman)
            ->post(route('leads.store'), ['lead_source_id' => ''])
            ->assertSessionHasErrors('lead_source_id');
    }

    /** @test */
    public function authorised_users_can_add_leads()
    {
        $user = UserFactory::regularUser()->create();

        $leadSource = create(LeadSource::class);

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
            ->assertSee($lead->name);
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
    public function a_lead_that_has_been_converted_cannot_be_marked_as_lost()
    {
        $user = create(User::class);

        $lead = LeadFactory::assignTo($user)->withClass('followed_up')->create();

        ContactFactory::associatedWith($lead)->create();

        $this->actingAs($user)
            ->get(route('leads.lost', $lead))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_users_can_mark_a_lead_as_lost()
    {
        $johnDoe = UserFactory::fromCompany(create(Company::class))->create();

        $lead = LeadFactory::assignTo($johnDoe)->withClass('followed_up')->create();

        create(LeadClass::class, ['slug' => 'lost']);

        $this->actingAs($johnDoe)
            ->get(route('leads.lost', $lead))
            ->assertRedirect(route('leads.show', $lead));

        $this->assertEquals($lead->fresh()->leadClass->slug, 'lost');
    }

    /** @test */
    public function a_user_cannot_convert_a_lead_which_does_not_belong_to_them()
    {
        $johnDoe = create(User::class);

        $lead = LeadFactory::withClass('followed_up')->assignTo(create(User::class))->create();

        $this->actingAs($johnDoe)
            ->get(route('leads.convert', $lead))
            ->assertForbidden();
    }

    /** @test */
    public function a_user_cannot_convert_a_lead_that_has_already_been_converted()
    {
        $johnDoe = create(User::class);

        $lead = LeadFactory::withClass('followed_up')->assignTo($johnDoe)->create();

        ContactFactory::associatedWith($lead)->create();

        $this->actingAs($johnDoe)
            ->get(route('leads.convert', $lead))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_user_can_convert_a_lead_to_contact()
    {
        $johnDoe = create(User::class);

        $lead = LeadFactory::withClass('followed_up')->assignTo($johnDoe)->create();

        create(LeadClass::class, ['slug' => 'converted']);

        $this->actingAs($johnDoe)
            ->get(route('leads.convert', $lead))
            ->assertRedirect(route('leads.show', $lead));

        $this->assertEquals($lead->id, Contact::first()->lead_id);

        $this->assertEquals($lead->contact->contactUser->user_id, $johnDoe->id);
    }

    /** @test */
    public function a_user_cannot_delete_a_lead_which_they_do_not_own()
    {
        $johnDoe = create(User::class);

        $lead = LeadFactory::withClass('followed_up')->assignTo(create(User::class))->create();

        $this->actingAs($johnDoe)
            ->delete(route('leads.destroy', $lead))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_user_cannot_delete_a_lead_that_has_been_converted()
    {
        $johnDoe = create(User::class);

        $lead = LeadFactory::withClass('followed_up')->assignTo($johnDoe)->create();

        ContactFactory::associatedWith($lead)->create();

        $this->actingAs($johnDoe)
            ->delete(route('leads.destroy', $lead))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_users_can_delete_leads()
    {
        $johnDoe = create(User::class);

        $lead = LeadFactory::withClass('followed_up')->assignTo($johnDoe)->create();

        $this->actingAs($johnDoe)
            ->delete(route('leads.destroy', $lead))
            ->assertRedirect(route('dashboard.user', $johnDoe));

        $this->assertNotNull($lead->fresh()->deleted_at);
    }

    /** @test */
    public function authorised_users_can_view_details_of_leads_assigned_to_them()
    {
        $goldmanSachs = create(Company::class);

        $deanThomas = UserFactory::fromCompany($goldmanSachs)->regularUser()->create();

        $seamusFinnigan = UserFactory::fromCompany($goldmanSachs)->regularUser()->create();

        $leadA = LeadFactory::fromCompany($goldmanSachs)->assignTo($deanThomas)->create();

        $leadB = LeadFactory::fromCompany($goldmanSachs)->assignTo($seamusFinnigan)->create();

        $jsonResponse = $this->actingAs($deanThomas)->get('/apis/leads/assigned');

        $jsonResponse->assertJsonFragment(['name' => $leadA->name]);

        $jsonResponse->assertJsonMissing(['name' => $leadB->name]);
    }
}
