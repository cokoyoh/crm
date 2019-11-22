<?php


namespace CRM\Deals;


trait DealStages
{
    public function scopePending($query)
    {
        return $this->getScope($query, 'pending');
    }

    public function scopeWon($query)
    {
        return $this->getScope($query, 'won');
    }

    public function scopeLost($query)
    {
        return $this->getScope($query, 'lost');
    }

    public function scopeVerified($query)
    {
        return $this->getScope($query, 'won-and-verified');
    }

    private function getScope($query, $stageSlug)
    {
        return $query->whereHas(
            'stage',
            function ($stage) use ($stageSlug) {
                $stage->where('slug', $stageSlug);
            });
    }
}
