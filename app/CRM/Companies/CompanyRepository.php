<?php


namespace CRM\Companies;


use CRM\Models\Company;
use CRM\RepositoryInterfaces\CreateInterface;

class CompanyRepository implements CreateInterface
{
    protected $company;

    /**
     * CompanyRepository constructor.
     * @param $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }


    public function create(array $attributes)
    {
//        $attributes['register_token'] = Str::random(10);

        return $this->company->create($attributes);
    }
}
