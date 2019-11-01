<?php

namespace Tests\Unit;

use CRM\Models\Lead;
use CRM\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_associated_with_a_lead()
    {
        $schedule = create(Schedule::class);

        $this->assertInstanceOf(Lead::class, $schedule->lead);
    }
}
