<?php

namespace App\Http\Controllers;

use CRM\Models\LeadSource;
use CRM\Transformers\LeadSourceTransformer;

class LeadSourcesController extends Controller
{
    protected $leadSourcesTransformer;

    /**
     * LeadSourcesController constructor.
     * @param $leadSourcesTransformer
     */
    public function __construct(
        LeadSourceTransformer $leadSourcesTransformer
    ) {
        $this->leadSourcesTransformer = $leadSourcesTransformer;
    }


    public function index()
    {
        $company = auth()->user()->company;

        $this->authorize('manageCompany', $company);

        $leadSources = $this->leadSourcesTransformer->transformCollection($company->leadSources);

        return view('leadsources.index', [
            'leadSources' => $leadSources
        ]);
    }


    public function store()
    {
        $this->authorize('manageLeadSource', new LeadSource());

        request()->validate(['name' => 'required|min:8']);

        LeadSource::create(request()->all());

        return redirect()->route('dashboard.user', auth()->user());
    }
}
