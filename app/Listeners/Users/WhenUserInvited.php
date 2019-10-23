<?php

namespace App\Listeners\Users;

use App\Events\Users\UserInvited;
use CRM\Models\User;

class WhenUserInvited
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
     * @param  UserInvited  $event
     * @return void
     */
    public function handle(UserInvited $event)
    {
        $user = $event->user;

        $admin = auth()->user();

        $company = $user->company;

        sendMail([
            'to' => $user->email,
            'firstname' => $user->first_name,
            'cc' => $company->email,
            'bcc' => [$company->email],
            'subject' => config('app.name') . ' - Invitation',
            'view' => 'emails.users.invite',
            'adminName' => $admin->name,
            'adminEmail' => $admin->email,
            'companyName' => $company->name,
            'companyEmail' => $company->email,
            'role' => $this->role($user),
            'id' => $user->id,
        ]);
    }

    private function role(User $user)
    {
        $role = $user->roleUser()->latest()->first()->role;

        if ($role) {
            return $role->name;
        }

        return '';
    }
}
