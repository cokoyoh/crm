<?php


namespace CRM\Companies;


use App\Events\Companies\CompanyProfileUpdated;
use CRM\Models\Company;
use CRM\Models\User;
use CRM\Users\UserRepository;

class CompanyProfilesRepository
{
    public function updateProfile(Company $company, $input)
    {
        $company = (new CompanyRepository($company))->update($company->id, $input);

        $user = $this->addUser($input)->addToCompany($company);

        $this->sendNotifications($user, $company->fresh());
    }

    private function addUser($input)
    {
        return (new UserRepository(new User()))
            ->create($input)
            ->addRole('admin');
    }

    private function sendNotifications($user, $company)
    {
        event(new CompanyProfileUpdated($user, $company));
    }
}
