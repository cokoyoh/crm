<?php

namespace App\Listeners\Users;

use App\Events\Users\UserAccountDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhenUserAccountDeleted
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
     * @param  UserAccountDeleted  $event
     * @return void
     */
    public function handle(UserAccountDeleted $event)
    {
        $user = $event->user;

        $company = $user->company;

        $companyEmail = $company->email;

        sendMail([
            'view' => 'emails.users.account_deleted',
            'to' => $user->email,
            'cc' => $company->admin->email,
            'bcc' => [$companyEmail],
            'subject' => config('app.name') . " - User Account Deleted",
            'firstname' => $user->first_name,
            'adminName' => auth()->user()->name,
            'adminEmail' => auth()->user()->email,
            'companyEmail' => $companyEmail
        ]);
    }
}
