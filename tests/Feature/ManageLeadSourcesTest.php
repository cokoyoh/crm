<?php

namespace Tests\Feature;

use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageLeadSourcesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_add_lead_sources()
    {
        $this->post(route('lead-sources.store'), [])
            ->assertRedirect('login');
    }

    /** @test */
    public function only_admins_can_add_lead_sources()
    {
        $user = UserFactory::withRole('user')->create();

        $this->actingAs($user)
            ->post(route('lead-sources.store'), [])
            ->assertForbidden();
    }

    /** @test */
    public function lead_source_name_is_required_when_adding_a_lead_source()
    {
        $user = UserFactory::withRole('admin')->create();

        $this->actingAs($user)
            ->post(route('lead-sources.store'), $attributes = ['name' => ''])
            ->assertSessionHasErrors('name');
    }


    /** @test */
    public function authorised_users_can_add_lead_sources()
    {
        $user = UserFactory::withRole('admin')->create();

        $this->actingAs($user)
            ->post(route('lead-sources.store'), $attributes = ['name' => 'Uhuru Park', 'slug' => 'uhuru_park'])
            ->assertRedirect(route('dashboard.user', $user));

        $this->assertDatabaseHas('lead_sources', $attributes);
    }
}
