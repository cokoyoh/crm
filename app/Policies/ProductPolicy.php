<?php

namespace App\Policies;

use CRM\Models\Product;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function manageProduct(User $user, Product $product)
    {
        return $user->isAdmin() && $product->company_id == $user->company_id;
    }

    public function view(User $user)
    {
        return $user->isAdmin();
    }
}
