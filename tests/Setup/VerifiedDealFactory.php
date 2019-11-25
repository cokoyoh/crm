<?php


namespace Tests\Setup;


use CRM\Models\Deal;
use CRM\Models\User;
use CRM\Models\VerifiedDeal;

class VerifiedDealFactory
{
    private $user = null;
    private $deal;
    private $createdAt = null;

    public function create()
    {
        $verifiedDeal = create(VerifiedDeal::class, [
            'user_id' => $this->user ? $this->user->id : null,
            'deal_id' => $this->deal ? $this->deal->id : null,
        ]);

        if ($this->createdAt) {
            $verifiedDeal->created_at = $this->createdAt;

            $verifiedDeal->updated_at = $this->createdAt;

            $verifiedDeal->save();

            $this->createdAt = null;
        }

        return $verifiedDeal->fresh();
    }

    public function verifiedBy(User $user = null)
    {
        $this->user = $user ?? create(User::class);

        return $this;
    }

    public function associatedWith(Deal $deal)
    {
        $this->deal = $deal;

        return $this;
    }

    public function monthAgo($days = 30)
    {
        $this->createdAt = now()->subDays($days);

        return $this;
    }
}
