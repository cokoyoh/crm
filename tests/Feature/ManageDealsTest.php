<?php

namespace Tests\Feature;

use CRM\Models\Company;
use CRM\Models\Deal;
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
        $deal = create(Deal::class);

        $this->get(route('deals.index'))
            ->assertRedirect('login');

        $this->post(route('deals.store'), [])
            ->assertRedirect('login');

        $this->get(route('deals.show', $deal))
            ->assertRedirect('login');

        $this->get(route('deals.mark-as-lost', $deal))
            ->assertRedirect('login');

        $this->get(route('deals.mark-as-won', $deal))
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

    /** @test */
    public function unauthorised_users_cannot_view_deal_details()
    {
        $company = create(Company::class);

        $user = UserFactory::fromCompany($company)->create();

        $deal = DealFactory::belongingTo(create(User::class))->create();

        $this->actingAs($user)
            ->get(route('deals.show', $deal))
            ->assertForbidden();
    }

    /** @test */
    public function a_user_cannot_mark_a_deal_as_lost_if_the_deal_does_not_belong_to_them()
    {
        $jeffBezos = UserFactory::regularUser()->create();

        $elonMusk = UserFactory::regularUser()->create();

        $deal = DealFactory::belongingTo($elonMusk)->pending()->create();

        $this->actingAs($jeffBezos)
            ->get(route('deals.mark-as-lost', $deal))
            ->assertForbidden();
    }

    /** @test */
    public function a_deal_in_stage_lost_cannot_be_marked_as_lost()
    {
        $elonMusk = UserFactory::regularUser()->create();

        $deal = DealFactory::belongingTo($elonMusk)->lost()->create();

        $this->actingAs($elonMusk)
            ->get(route('deals.mark-as-lost', $deal))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_user_can_mark_a_deal_as_lost()
    {
        $elonMusk = UserFactory::regularUser()->create();

        $deal = DealFactory::belongingTo($elonMusk)->pending()->create();

        create(DealStage::class, ['slug' => 'lost']);

        $this->actingAs($elonMusk)
            ->get(route('deals.mark-as-lost', $deal))
            ->assertRedirect(route('deals.show', $deal));

        $this->assertEquals($deal->fresh()->stage->slug, 'lost');
    }

    /** @test */
    public function unauthorised_users_cannot_mark_a_deal_as_won()
    {
        $auntMargery = UserFactory::regularUser()->create();

        $anImposter = UserFactory::regularUser()->create();

        $deal = DealFactory::belongingTo($auntMargery)->pending()->create();

        $this->actingAs($anImposter)
            ->get(route('deals.mark-as-won', $deal))
            ->assertForbidden();
    }

    /** @test */
    public function a_deal_that_is_already_marked_as_won_cannot_be_remarked_as_such()
    {
        $auntMargery = UserFactory::regularUser()->create();

        $deal = DealFactory::belongingTo($auntMargery)->won()->create();

        $this->actingAs($auntMargery)
            ->get(route('deals.mark-as-won', $deal))
            ->assertForbidden();
    }

    /** @test */
    public function a_deal_that_is_already_marked_as_lost_cannot_be_marked_as_won()
    {
        $auntMargery = UserFactory::regularUser()->create();

        $deal = DealFactory::belongingTo($auntMargery)->lost()->create();

        $this->actingAs($auntMargery)
            ->get(route('deals.mark-as-won', $deal))
            ->assertForbidden();
    }

    /** @test */
    public function authorised_users_can_mark_a_deal_as_won()
    {
        $auntMargery = UserFactory::regularUser()->create();

        $deal = DealFactory::belongingTo($auntMargery)->pending()->create();

        create(DealStage::class, ['slug' => 'won']);

        $this->actingAs($auntMargery)
            ->get(route('deals.mark-as-won', $deal))
            ->assertRedirect(route('deals.show', $deal));

        $this->assertEquals($deal->fresh()->stage->slug, 'won');
    }
}
