<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\DealStage;
use CRM\Models\User;
use Facades\Tests\Setup\ContactFactory;
use Facades\Tests\Setup\ProductFactory;
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

        $this->post(route('deals.store'), [])
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

    /** @test */
    public function deal_amount_is_required_when_adding_a_deal()
    {
        $user = create(User::class);

        $this->actingAs($user)
            ->post(route('deals.store'), ['amount' => ''])
            ->assertSessionHasErrors('amount');
    }

    /** @test */
    public function product_id_is_required_when_adding_a_deal()
    {
        $user = create(User::class);

        $this->actingAs($user)
            ->post(route('deals.store'), ['product_id' => ''])
            ->assertSessionHasErrors('product_id');
    }

    /** @test */
    public function contact_id_is_required_when_adding_a_deal()
    {
        $user = create(User::class);

        $this->actingAs($user)
            ->post(route('deals.store'), ['contact_id' => ''])
            ->assertSessionHasErrors('contact_id');
    }


    /** @test */
    public function authorised_users_can_add_deals()
    {
        $company = create(Company::class);

        $dumbledore = UserFactory::fromCompany($company)->regularUser()->create();

        $contact = ContactFactory::assignTo($company)->create();

        $product = ProductFactory::fromCompany($company)->create();

        $dealStage = create(DealStage::class, ['slug' => 'pending']);

        $input = [
            'contact_id' => $contact->id,
            'product_id' => $product->id,
            'name' => 'Some deal name or description',
            'amount' => '34500'
        ];

        $this->actingAs($dumbledore)
            ->post(route('deals.store'), $input)
            ->assertRedirect();

        $this->assertDatabaseHas('clients', ['contact_id' => $contact->id]);

        $this->assertDatabaseHas('deals', [
            'name' => $input['name'],
            'amount' => $input['amount'],
            'deal_stage_id' => $dealStage->id
        ]);
    }
}
