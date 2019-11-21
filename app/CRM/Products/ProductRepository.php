<?php


namespace CRM\Products;


use CRM\RepositoryInterfaces\CreateInterface;

class ProductRepository implements CreateInterface
{

    public function create(array $attributes)
    {
         return auth()
             ->user()
             ->company
             ->products()
             ->create($attributes);
    }

    public function getCompanyProducts()
    {
        return auth()
            ->user()
            ->company
            ->products()
            ->latest()
            ->paginate(8);
    }
}
