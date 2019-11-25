<?php


namespace CRM\Deals;


trait DealPercentageChanges
{
    public function dealPercentageChange()
    {
        $dealsVerifiedLastMonth = $this->dealsVerifiedLastMonth();

        $dealsVerifiedThisMonth = $this->dealsVerifiedThisMonth();

        return percentage($dealsVerifiedLastMonth, $dealsVerifiedThisMonth);
    }

    private function dealsVerifiedLastMonth()
    {
        return $this->userDeals()
            ->whereHas('verifiedDeal',
                function ($verifiedDeal) {
                    $verifiedDeal->where('created_at', '<', $this->startOfMonth());
                })
            ->sum('amount');
    }

    private function dealsVerifiedThisMonth()
    {
        return $this->userDeals()
            ->whereHas('verifiedDeal',
                function ($verifiedDeal) {
                    $verifiedDeal->where('created_at', '>=', $this->startOfMonth());
                })
            ->sum('amount');
    }

    private function userDeals()
    {
        return $this->deals()->verified();
    }

    private function startOfMonth()
    {
        return now()->startOfMonth();
    }
}
