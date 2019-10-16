<?php


namespace CRM\Companies;


use CRM\Models\Company;
use CRM\RepositoryInterfaces\CreateInterface;
use CRM\RepositoryInterfaces\FindInterface;
use CRM\RepositoryInterfaces\UpdateInterface;
use Illuminate\Support\Str;

class CompanyRepository implements CreateInterface, FindInterface, UpdateInterface
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

    public function findById(int $companyId)
    {
        return Company::findOrFail($companyId);
    }


    public function create(array $attributes)
    {
        return $this->company->create($attributes);
    }

    public function update($companyId, array $attributes)
    {
        $this->company = $this->findById($companyId);

        $this->company->update([
            'name' => $attributes['company_name'],
            'email' => $attributes['company_email'],
            'register_token' => Str::random(10),
            'confirmed_at' => now()
        ]);

        return $this->company->fresh();
    }
}
