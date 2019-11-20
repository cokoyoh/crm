<?php

namespace Tests\Unit;

use CRM\Models\Contact;
use CRM\Models\Interaction;
use CRM\Models\Lead;
use CRM\Models\LeadAssignee;
use CRM\Models\LeadClass;
use CRM\Models\LeadNote;
use CRM\Models\LeadSource;
use CRM\Models\User;
use Facades\Tests\Setup\ContactFactory;
use Facades\Tests\Setup\InteractionFactory;
use Facades\Tests\Setup\LeadFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Setup\UserFactory;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_lead_assignee()
    {
        $lead = create(Lead::class);

        create(LeadAssignee::class, [
            'lead_id' => $lead->id
        ]);

        $this->assertInstanceOf(LeadAssignee::class, $lead->leadAssignee);

        $this->assertEquals($lead->id, $lead->leadAssignee->lead_id);
    }

    /** @test */
    public function it_marks_a_lead_as_not_followed_up()
    {
        $lead = create(Lead::class, ['lead_class_id' => null]);

        $leadClass = create(LeadClass::class, ['slug' => 'not_followed_up']);

        $this->assertNull($lead->lead_class_id);

        $lead->markAsNotFollowedUp();

        $this->assertEquals($lead->lead_class_id, $leadClass->id);
    }

    /** @test */
    public function it_marks_a_lead_as_followed_up()
    {
        $taylorSwift = create(User::class);

        $lead = LeadFactory::assignTo($taylorSwift)->withClass('not_followed_up')->create();

        create(LeadClass::class, ['slug' => 'followed_up']);

        $lead->markAsFollowedUp();

        $this->assertEquals($lead->fresh()->lead_class_id, 2);
    }

    /** @test */
    public function it_can_mark_a_lead_as_lost()
    {
        $lead = create(Lead::class);

        create(LeadClass::class, ['slug' => 'lost']);

        $lead->markAsLost();

        $this->assertEquals($lead->leadClass->slug, 'lost');
    }

    /** @test */
    public function it_can_mark_a_lead_as_converted()
    {
        $lead = create(Lead::class);

        create(LeadClass::class, ['slug' => 'converted']);

        $lead->markAsConverted();

        $this->assertEquals($lead->leadClass->slug, 'converted');
    }

    /** @test */
    public function it_can_reassign_a_lead()
    {
        $drecoMalfoy = create(User::class);

        $nevilleLongbottom = create(User::class);

        $lead = LeadFactory::assignTo($drecoMalfoy)->create();

        $lead->assign($nevilleLongbottom);

        $this->assertTrue($lead->isAssigned($nevilleLongbottom));

        $this->assertFalse($lead->isAssigned($drecoMalfoy));
    }

    /** @test */
    public function it_has_a_name()
    {
        $lead = create(Lead::class, [
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $this->assertEquals($lead->name, 'John Doe');
    }

    /** @test */
    public function it_has_a_class()
    {
        $leadClass = create(LeadClass::class, ['slug' => 'converted']);

        $lead = create(Lead::class, ['lead_class_id' => $leadClass->id]);

        $this->assertEquals('converted', $lead->leadClass->slug);
    }

    /** @test */
    public function it_is_an_instance_of_interaction_class()
    {
        $lead = create(Lead::class);

        create(Interaction::class, ['lead_id' => $lead->id]);

        $this->assertInstanceOf(Interaction::class, $lead->interactions()->first());
    }

    /** @test */
    public function it_can_add_an_interaction()
    {
        $lead = create(Lead::class);

        $lead->addInteraction([
            'user_id' => create(User::class)->id,
            'lead_id' => $lead->id
        ]);

        $this->assertCount(1, $lead->interactions);
    }

    /** @test */
    public function it_checks_if_a_lead_is_assigned_to_a_given_user()
    {
        $lead = create(Lead::class);

        $user = create(User::class);

        create(LeadAssignee::class, [
            'lead_id' => $lead->id,
            'user_id' => $user->id
        ]);

        $this->assertTrue($lead->isAssigned($user));
    }

    /** @test */
    public function it_has_status()
    {
        $lead = LeadFactory::withClass('not_followed_up')->create();

        $this->assertEquals($lead->status, 'New');
    }

    /** @test */
    public function it_is_an_instance_of_lead_note()
    {
        $lead = create(Lead::class);

        create(LeadNote::class, ['lead_id' => $lead->id]);

        $this->assertInstanceOf(LeadNote::class, $lead->notes);
    }

    /** @test */
    public function it_can_add_notes_to_a_lead()
    {
        $lead = create(Lead::class);

        $notes = $lead->addNotes(['body' => 'Some notes']);

        $this->assertInstanceOf(LeadNote::class, $notes);
    }

    /** @test */
    public function it_capitalizes_the_first_letter_of_the_first_name()
    {
        $lead = create(Lead::class, ['first_name' => 'emmy']);

        $this->assertEquals('Emmy', $lead->first_name);
    }

    /** @test */
    public function it_capitalizes_the_first_letter_of_the_last_name()
    {
        $lead = create(Lead::class, ['last_name' => 'adede']);

        $this->assertEquals('Adede', $lead->last_name);
    }

    /** @test */
    public function it_has_a_contact()
    {
        $lead = create(Lead::class);

        ContactFactory::associatedWith($lead)->create();

        $this->assertInstanceOf(Contact::class, $lead->contact);
    }

    /** @test */
    public function it_converts_a_lead_to_a_contact()
    {
        create(LeadClass::class, ['slug' => 'converted']);

        $lead = create(Lead::class);

        $lead->convert();

        $this->assertCount(1, Contact::all());
    }

    /** @test */
    public function it_expunges_a_lead_and_associated_records()
    {
        $user = create(User::class);

        $lead = LeadFactory::assignTo($user)->create();

        InteractionFactory::fromLead($lead)->belongingTo($user)->create();

        $this->assertEquals(1, LeadAssignee::count());

        $this->assertCount(1, $lead->interactions);

        $lead->expunge();

        $this->assertEquals(0, LeadAssignee::count());

        $this->assertEquals(0, Interaction::count());
    }

    /** @test */
    public function it_has_a_source()
    {
        $source = create(LeadSource::class)->create();

        $lead = LeadFactory::source($source)->create();

        $this->assertInstanceOf(LeadSource::class, $lead->leadSource);
    }

    /** @test */
    public function it_gets_converted_leads_only()
    {
        $unconvertedLead = LeadFactory::create();

        $convertedLead = LeadFactory::withClass('converted')->create();

        ContactFactory::associatedWith($convertedLead)->create();

        $convertedLeads = Lead::converted()->get();

        $this->assertTrue($convertedLeads->contains($convertedLead));

        $this->assertFalse($convertedLeads->contains($unconvertedLead));
    }

    /** @test */
    public function it_gets_lost_leads_only()
    {
        $lostLead = LeadFactory::withClass('lost')->create();

        $convertedLead = LeadFactory::withClass('converted')->create();

        $lostLeadsCollection = Lead::lost()->get();

        $this->assertTrue($lostLeadsCollection->contains($lostLead));

        $this->assertFalse($lostLeadsCollection->contains($convertedLead));
    }
}
