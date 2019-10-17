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
        $data = [
            'view' => 'emails.companies.notify_company_admin',
            'to' => $user->email,
            'cc' => $company->email,
            'subject' => config('app.name') . ' - ' . $company->name .' Profile',
            'firstname' => $user->first_name,
            'role' => $this->role($user),
            'companyName' => $company->name
        ];

        sendMail($data);
    }

    private function notifyRegisteredCompany($user, $company)
    {
        $data = [
            'to' => $company->email,
            'cc' => $user->email,
            'view' => 'emails.companies.notify_company',
            'firstname' => 'Sir/Madam',
            'adminName' => $user->fullname,
            'companyName' => $company->name,
            'companyEmail' => $company->email,
            'adminRole' => $this->role($user)
        ];

        sendMail($data);
    }

    private function role($user)
    {
        return optional($user->userRoles()->latest()->first())->name;
    }
}
