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

    public function pending()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            Deal::pending()->latest()->paginate(8);
        }

        if ($user->isAdmin()) {
            return $user->company->deals()->pending()->paginate(8);
        }

        return $user->deals()->pending()->paginate(8);
    }

    public function lost()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            Deal::lost()->latest()->paginate(8);
        }

        if ($user->isAdmin()) {
            return $user->company->deals()->lost()->paginate(8);
        }

        return $user->deals()->lost()->paginate(8);
    }

    public function won()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            Deal::won()->latest()->paginate(8);
        }

        if ($user->isAdmin()) {
            return $user->company->deals()->won()->paginate(8);
        }

        return $user->deals()->won()->paginate(8);
    }

    public function verified()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            Deal::verified()->latest()->paginate(8);
        }

        if ($user->isAdmin()) {
            return $user->company->deals()->verified()->paginate(8);
        }

        return $user->deals()->verified()->paginate(8);
    }
}
