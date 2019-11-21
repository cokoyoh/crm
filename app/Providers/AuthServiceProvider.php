<?php

namespace App\Providers;

use App\Policies\CompanyPolicy;
use App\Policies\InteractionPolicy;
use App\Policies\LeadPolicy;
use App\Policies\LeadSourcePolicy;
use App\Policies\ProductPolicy;
use App\Policies\SchedulePolicy;
use App\Policies\UserPolicy;
use CRM\Models\Company;
use CRM\Models\Interaction;
use CRM\Models\Lead;
use CRM\Models\LeadSource;
use CRM\Models\Product;
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
        Schedule::class => SchedulePolicy::class,
        Interaction::class => InteractionPolicy::class,
        LeadSource::class => LeadSourcePolicy::class,
        Product::class => ProductPolicy::class
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
