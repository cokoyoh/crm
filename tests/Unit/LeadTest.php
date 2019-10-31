<?php

namespace Tests\Unit;

use CRM\Models\Lead;
use CRM\Models\LeadAssignee;
use CRM\Models\LeadClass;
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
}
