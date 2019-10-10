<?php

namespace Tests\Unit;

use CRM\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_super_admin_role()
    {
        $jane = create(User::class);

        $john = create(User::class);

        $this->addRole($john, 'super_admin');

        $this->assertTrue($john->isSuperAdmin());

        $this->assertFalse($jane->isSuperAdmin());
    }
}
