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

        'App\Events\Companies\CompanyProfileUpdated' => [
            'App\Listeners\Companies\WhenCompanyProfileUpdated'
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
