<?php

namespace App\Listeners\Deals;

use App\Events\Deals\DealMarkedAsLost;
use CRM\Models\Deal;
use CRM\Models\User;
use CRM\Transformers\DealTransformer;
use CRM\Transformers\UserTransformer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhenDealMarkedAsLost
{
    private $dealTransformer;

    /**
     * Create the event listener.
     *
     * @param DealTransformer $dealTransformer
     */
    public function __construct(
        DealTransformer $dealTransformer
    ) {
        $this->dealTransformer = $dealTransformer;
    }

    /**
     * Handle the event.
     *
     * @param  DealMarkedAsLost  $event
     * @return void
     */
    public function handle(DealMarkedAsLost $event)
    {
        $deal = $event->deal;

        $company = $deal->user->company;

        $companyAdmin = $company ? $company->admin : null;

        if ($companyAdmin) {
            $this->notifyCompanyAdmin($companyAdmin, $deal, $company);
        }
    }

    private function notifyCompanyAdmin($admin, $deal, $company)
    {
        sendMail([
            'to' => $admin->email,
            'firstname' => $admin->first_name,
            'cc' => $company ? $company->email: '',
            'subject' => config('app.name') . ' - Deal Lost Notification',
            'deal' => $this->dealTransformer->transform($deal),
            'view' => 'emails.deals.deal_lost_notification'
        ]);
    }
}
