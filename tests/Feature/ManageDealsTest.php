<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\DealFactory;
use Tests\TestCase;

class ManageDealsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_manage_deals()
    {
        $this->get(route('deals.index'))
            ->assertRedirect('login');
    }

    /** @test */
    public function authorised_users_can_view_their_deals()
    {
        $user = UserFactory::fromCompany(create(Company::class))->admin()->create();

        $dealA = DealFactory::belongingTo($user)->pending()->create();

        $dealB = DealFactory::belongingTo(create(User::class))->pending()->create();

        $jsonResponse = $this->actingAs($user)->get('/apis/deals');

        $jsonResponse->assertJsonFragment(['name' => $dealA->name]);

        $jsonResponse->assertJsonMissing(['name' => $dealB->name]);
    }
}
