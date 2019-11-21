<?php


namespace Tests\Setup;


use CRM\Models\Company;
use CRM\Models\Product;

class ProductFactory
{
    private $company = null;

    public function create()
    {
        $companyId = $this->company ? $this->company->id : null;

        return create(Product::class, [
            'company_id' => $companyId
        ]);
    }

    public function fromCompany(Company $company = null)
    {
        $this->company = $company ?? create(Company::class);

        return $this;
    }
}
