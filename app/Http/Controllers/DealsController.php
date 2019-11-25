<?php

namespace App\Http\Controllers;

use App\Events\Deals\DealMarkedAsLost;
use App\Events\Deals\DealMarkedAsWon;
use App\Http\Controllers\Apis\ApiController;
use App\Http\Requests\StoreDealRequest;
use CRM\Clients\ClientsRepository;
use CRM\Deals\DealsRepository;
use CRM\Models\Client;
use CRM\Models\Deal;
use CRM\Transformers\DealTransformer;
use Illuminate\Support\Facades\DB;

class DealsController extends ApiController
{
    private $dealTransformer;
    private $clientsRepository;
    private $dealsRepository;

    /**
     * DealsController constructor.
     * @param DealTransformer $dealTransformer
     * @param ClientsRepository $clientsRepository
     * @param DealsRepository $dealsRepository
     */
    public function __construct(
        DealTransformer $dealTransformer,
        ClientsRepository $clientsRepository,
        DealsRepository $dealsRepository
    ) {
        $this->dealTransformer = $dealTransformer;
        $this->clientsRepository = $clientsRepository;
        $this->dealsRepository = $dealsRepository;
    }


    public function index()
    {
        return view('deals.index');
    }

    public function pending()
    {
        return view('deals.pending');
    }

    public function won()
    {
        return view('deals.won');
    }

    public function verified()
    {
        return view('deals.verified');
    }

    public function show(Deal $deal)
    {
        $this->authorize('manageDeal', $deal);

        $dealArray = $this->dealTransformer->transform($deal);

        return view('deals.show', [
            'deal' => $deal,
            'dealArray' => $dealArray,
            'notes' => $deal->notes,
        ]);
    }

    public function store(StoreDealRequest $request)
    {
        $contactId = request('contact_id');

        $client = $this->clientsRepository->findOrCreateClientByContactId($contactId);

        $input = request()->except('contact_id') + ['client_id' => $client->id];

        $deal = $this->dealsRepository->create($input);

        if (request()->wantsJson()) {
            return $this->respondSuccess([
                'deal' => $this->dealTransformer->transform($deal),
                'message' => 'Deal saved successfully'
            ]);
        }

        flash('Deal saved successfully', 'success');

        return redirect()->back();
    }

    public function markAsLost(Deal $deal)
    {
        $this->authorize('markAsLost', $deal);

        DB::transaction(function () use ($deal) {
            $deal->markAsLost();

            flash('Deal has been marked as lost', 'success');

            event(new DealMarkedAsLost($deal->fresh()));
        });

        return redirect()->route('deals.show', $deal);
    }

    public function markAsWon(Deal $deal)
    {
        $this->authorize('markAsWon', $deal);

        DB::transaction(function () use ($deal) {
            $deal->markAsWon();

            flash('Congratulations, deal has been won!', 'success');

            event(new DealMarkedAsWon($deal));
        });

        return redirect()->route('deals.show', $deal);
    }
}
