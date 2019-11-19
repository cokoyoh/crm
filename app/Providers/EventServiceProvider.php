<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        'App\Events\Companies\CompanyInvited' => [
            'App\Listeners\Companies\WhenCompanyInvited'
        ],

        'App\Events\Users\UserInvited' => [
            'App\Listeners\Users\WhenUserInvited'
        ],

        'App\Events\Users\UserAccountDeleted' => [
            'App\Listeners\Users\WhenUserAccountDeleted'
        ],

        'App\Events\Companies\CompanyProfileUpdated' => [
            'App\Listeners\Companies\WhenCompanyProfileUpdated'
        ],

         'App\Events\Leads\LeadMarkedAsLost' => [
            'App\Listeners\Leads\WhenLeadMarkedAsLost'
        ],

        'App\Events\Leads\LeadReassigned' => [
            'App\Listeners\Leads\WhenLeadReassigned'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
