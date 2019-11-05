<?php

namespace App\Providers;

use App\Policies\CompanyPolicy;
use App\Policies\LeadPolicy;
use App\Policies\SchedulePolicy;
use App\Policies\UserPolicy;
use CRM\Models\Company;
use CRM\Models\Lead;
use CRM\Models\Schedule;
use CRM\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        User::class => UserPolicy::class,
        Lead::class => LeadPolicy::class,
        Schedule::class => SchedulePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *c
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
