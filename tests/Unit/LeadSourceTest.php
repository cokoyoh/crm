<?php

namespace Tests\Unit;

use CRM\Models\Lead;
use CRM\Models\LeadSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadSourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_a_slug()
    {
        $leadSource = create(LeadSource::class, ['name' => 'this is a trial']);

        $this->assertEquals($leadSource->slug, 'this-is-a-trial');
    }

    /** @test */
    public function it_has_leads()
    {
        $leadSource = create(LeadSource::class);

        $lead = create(Lead::class, ['lead_source_id' => $leadSource->id]);

        $this->assertTrue($leadSource->leads->contains($lead));
    }
}
