<?php

namespace Tests\Unit;

use CRM\Models\User;
use Facades\Tests\Setup\LeadFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadAssigneeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $jeremy = create(User::class);

        $lead = LeadFactory::assignTo($jeremy)->create();

        $this->assertInstanceOf(User::class, $lead->leadAssignee->user);
    }
}
