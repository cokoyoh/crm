<?php


namespace Tests\Setup;


use CRM\Models\Client;
use CRM\Models\Deal;
use CRM\Models\DealStage;
use CRM\Models\Product;
use CRM\Models\User;

class DealFactory
{
    private $user = null;
    private $dealStage = null;
    private $product = null;
    private $client = null;

    public function create()
    {
        return create(Deal::class, [
            'user_id' => $this->user ? $this->user->id : null,
            'product_id' => $this->product ? $this->product->id : null,
            'client_id' => $this->client ? $this->client->id : null,
            'deal_stage_id' => $this->dealStage ? $this->dealStage->id : null,
        ]);
    }

    public function belongingTo(User $user = null)
    {
        $this->user = $user ? $user : create(User::class);

        return $this;
    }

    public function forProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    public function associatedWith(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    public function pending()
    {
        $this->stage('pending');

        return $this;
    }

    public function lost()
    {
        $this->stage('lost');

        return $this;
    }

    public function won()
    {
        $this->stage('won');

        return $this;
    }

    public function wonAndVerified()
    {
        $this->stage('won-and-verified');

        return $this;
    }

    public function stage(String $dealStageSlug)
    {
        $this->dealStage = create(DealStage::class, ['slug' => $dealStageSlug]);
    }
}
