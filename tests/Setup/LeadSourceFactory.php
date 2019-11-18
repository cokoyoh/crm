<?php


namespace Tests\Setup;


use CRM\Models\Company;
use CRM\Models\LeadSource;

class LeadSourceFactory
{
    protected $company;

    public function create()
    {
        $companyId = $this->company ? $this->company->id : null;

        return create(LeadSource::class, [
            'company_id' => $companyId
        ]);
    }

    public function forCompany($company = null)
    {
        $this->company = $company ?? create(Company::class);

        return $this;
    }
}
