<?php

namespace Tests\Unit;

use CRM\Models\Interaction;
use CRM\Models\Lead;
use CRM\Models\LeadAssignee;
use CRM\Models\LeadClass;
use CRM\Models\User;
use Facades\Tests\Setup\LeadFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    public function it_changes_a_lead_class_id()
    {
        $lead = create(Lead::class, ['lead_class_id' => null]);

        $leadClass = create(LeadClass::class, ['slug' => 'not_followed_up']);

        $this->assertNull($lead->lead_class_id);

        $lead->markAsNotFollowedUp();

        $this->assertEquals($lead->lead_class_id, $leadClass->id);
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
}
