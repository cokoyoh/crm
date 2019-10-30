<?php

namespace Tests\Unit;

use CRM\Models\Lead;
use CRM\Models\LeadAssignee;
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
}
