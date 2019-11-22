<?php


namespace CRM\Deals;


use CRM\Models\Deal;

class DealsRepository
{
    public function userDeals()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            Deal::latest()->paginate(8);
        }

        if ($user->isAdmin()) {
            return $user->company->deals()->paginate(8);
        }

        return $user->deals()->paginate(8);
    }
}
