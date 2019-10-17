<?php

namespace App\Listeners\Companies;

use App\Events\Companies\CompanyProfileUpdated;

class WhenCompanyProfileUpdated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CompanyProfileUpdated  $event
     * @return void
     */
    public function handle(CompanyProfileUpdated $event)
    {
        $company = $event->company;

        $user = $event->user;

        $this->notifyUser($user, $company);

        $this->notifyRegisteredCompany($user, $company);
    }

    private function notifyUser($user, $company)
    {
        sendMail([
            'view' => 'emails.companies.notify_company_admin',
            'to' => $user->email,
            'cc' => $company->email,
            'subject' => config('app.name') . ' - ' . $company->name .' Profile',
            'firstname' => $user->first_name,
            'role' => $this->role($user),
            'companyName' => $company->name
        ]);
    }

    private function notifyRegisteredCompany($user, $company)
    {
        sendMail([
            'to' => $company->email,
            'cc' => $user->email,
            'view' => 'emails.companies.notify_company',
            'subject' => config('app.name') . ' - ' . $company->name . ' Profile Update',
            'firstname' => 'Sir/Madam',
            'adminName' => $user->fullname,
            'adminEmail' => $user->email,
            'companyName' => $company->name,
            'companyEmail' => $company->email,
            'adminRole' => $this->role($user)
        ]);
    }

    private function role($user)
    {
        $roleUser = $user->roleUser()->latest()->first();

        if ($roleUser) {
            return $roleUser->role->name;
        }

        return '';
    }
}
