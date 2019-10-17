<?php

namespace App\Listeners\Companies;

use App\Events\Companies\CompanyInvited;
use App\Mail\SimpleMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class WhenCompanyInvited implements ShouldQueue
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
     * @param  CompanyInvited  $event
     * @return void
     */
    public function handle(CompanyInvited $event)
    {
        $company = $event->company;

        tap($company, function ($company) {
            $data = [
                'to' => $company->email,
                'subject' => 'Welcome to ' . config('app.name'),
                'view' => 'emails.companies.invite',
                'id' => $company->id,
                'companyName' => $company->name
            ];

            sendMail($data);
        });
    }
}
