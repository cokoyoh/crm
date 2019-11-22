<?php

namespace Tests\Unit;

use CRM\Models\Deal;
use CRM\Models\DealStage;
use CRM\Models\Product;
use CRM\Models\User;
use Facades\Tests\Setup\DealFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
