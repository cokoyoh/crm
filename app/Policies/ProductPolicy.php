<?php

namespace App\Policies;

use CRM\Models\Product;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function manageProduct(User $user, Product $product)
    {
        return $user->isAdmin() && $this->isSameCompany($user, $product);
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user)
    {
        return $user->isAdmin();
    }

    public function destroy(User $user, Product $product)
    {
        return $user->isAdmin() && $this->isSameCompany($user, $product);
    }

    private function isSameCompany(User $user, Product $product)
    {
        return $user->company_id == $product->company_id;
    }
}
