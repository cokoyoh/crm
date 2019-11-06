<?php

namespace Tests\Unit;

use CRM\Models\Lead;
use Facades\Tests\Setup\InteractionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InteractionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_an_instance_of_a_lead()
    {
        $interaction = InteractionFactory::create();

        $this->assertInstanceOf(Lead::class, $interaction->lead);
    }
}
