<?php

namespace Tests\Unit;

use CRM\Models\Client;
use CRM\Models\Company;
use CRM\Models\Deal;
use CRM\Models\DealNote;
use CRM\Models\DealStage;
use CRM\Models\Product;
use CRM\Models\User;
use CRM\Models\VerifiedDeal;
use Facades\Tests\Setup\DealFactory;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\VerifiedDealFactory;
use Tests\TestCase;

class DealTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $deal = DealFactory::belongingTo(create(User::class))->create();

        $this->assertInstanceOf(User::class, $deal->user);
    }

    /** @test */
    public function a_deal_has_a_product()
    {
        $product = create(Product::class);

        $deal = DealFactory::forProduct($product)->create();

        $this->assertInstanceOf(Product::class, $deal->product);
    }

    /** @test */
    public function a_deal_has_a_stage()
    {
        $deal = DealFactory::pending()->create();

        $this->assertInstanceOf(DealStage::class, $deal->stage);
    }

    /** @test */
    public function it_fetches_only_pending_deals()
    {
        $pendingDeal = DealFactory::pending()->create();

        $wonDeal = DealFactory::won()->create();

        $this->assertTrue(Deal::pending()->get()->contains($pendingDeal));

        $this->assertFalse(Deal::pending()->get()->contains($wonDeal));
    }

    /** @test */
    public function it_marks_a_deal_as_pending()
    {
        create(DealStage::class, ['slug' => 'pending']);

        $deal = DealFactory::pending()->create();

        $deal->markAsPending();

        $this->assertEquals($deal->stage->slug, 'pending');
    }

    /** @test */
    public function it_marks_a_deal_as_lost()
    {
        create(DealStage::class, ['slug' => 'lost']);

        $deal = DealFactory::pending()->create();

        $deal->markAsLost();

        $this->assertEquals($deal->stage->slug, 'lost');
    }

    /** @test */
    public function it_marks_a_deal_as_won()
    {
        create(DealStage::class, ['slug' => 'won']);

        $deal =  DealFactory::pending()->create();

        $deal->markAsWon();

        $this->assertEquals($deal->stage->slug, 'won');
    }

    /** @test */
    public function a_deal_has_a_client()
    {
        $client = create(Client::class);

        $deal = DealFactory::associatedWith($client)->create();

        $this->assertInstanceOf(Client::class, $deal->client);
    }

    /** @test */
    public function a_deal_has_notes()
    {
        $deal = create(Deal::class);

        create(DealNote::class, ['deal_id' => $deal->id]);

        $this->assertInstanceOf(DealNote::class, $deal->notes);
    }

    /** @test */
    public function it_can_add_notes_to_a_deal()
    {
        $user = create(User::class);

        $deal = DealFactory::belongingTo($user)->create();

        $deal->addNotes(['user_id' => $user->id, 'body' => 'some notes']);

        $this->assertInstanceOf(DealNote::class, $deal->fresh()->notes);
    }

    /** @test */
    public function it_has_a_verified_deal()
    {
        $deal = DealFactory::won()->create();

        VerifiedDealFactory::associatedWith($deal)->create();

        $this->assertInstanceOf(VerifiedDeal::class, $deal->verifiedDeal);
    }

    /** @test */
    public function it_gets_deals_increase_or_decrease_month_on_month()
    {
        $user = UserFactory::regularUser()->create();

        $dealA = DealFactory::belongingTo($user)->won()->create();

        $dealB = DealFactory::belongingTo($user)->won()->create();

        VerifiedDealFactory::associatedWith($dealA)->monthAgo()->create();

        VerifiedDealFactory::associatedWith($dealB)->create();

        $this->assertNotNull($user->dealPercentageChange());
    }
}
