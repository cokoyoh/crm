<?php


namespace App\Repositories\Company;


use CRM\Models\Company;
use Illuminate\Support\Str;

class CompanyRepository implements CompanyInterface
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
        $attributes['register_token'] =Str::random(10);

        return $this->company->create($attributes);
    }
}
