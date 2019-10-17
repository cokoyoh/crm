<?php

namespace App\Listeners\Companies;

use App\Events\Companies\CompanyProfileUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

        //send mail to the user designated as the admin

        //send mail to the company detailing the updated details
    }

    private function notifyUser($user, $company)
    {
        $data = [
            'view' => 'emails.companies.notify_company_admin',
            'to' => $user->email,
            'cc' => $company->email,
            'subject' => config('app.name') . ' - ' . $company->name .' Profile', //Jamiicare CRM - Horgwarts LLC Profile
        ];
    }
}
