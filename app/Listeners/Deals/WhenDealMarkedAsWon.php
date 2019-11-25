<?php

namespace App\Listeners\Deals;

use App\Events\Deals\DealMarkedAsWon;
use CRM\Transformers\DealTransformer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhenDealMarkedAsWon
{
    private $dealTransformer;

    /**
     * Create the event listener.
     *
     * @param DealTransformer $dealTransformer
     */
    public function __construct(DealTransformer $dealTransformer)
    {
        $this->dealTransformer = $dealTransformer;
    }

    /**
     * Handle the event.
     *
     * @param  DealMarkedAsWon  $event
     * @return void
     */
    public function handle(DealMarkedAsWon $event)
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
            'cc' => auth()->user()->email,
            'bcc' => [$company ? $company->email: ''],
            'subject' => config('app.name') . ' - Deal Won Notification',
            'deal' => $this->dealTransformer->transform($deal),
            'view' => 'emails.deals.deal_won_notification'
        ]);
    }
}
