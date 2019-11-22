<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\ApiController;
use CRM\Models\LeadSource;
use CRM\Transformers\LeadSourceTransformer;

class LeadSourcesController extends ApiController
{
    public function index()
    {
        $company = auth()->user()->company;

        $this->authorize('manageCompany', $company);

        return view('leadsources.index', [
            'company' => $company
        ]);
    }


    public function store()
    {
        $this->authorize('create', LeadSource::class);

        request()->validate(['name' => 'required|min:8']);

        $leadSource = LeadSource::create(request()->all());

        if (request()->wantsJson()) {
            return $this->respondSuccess([
                'id' => $leadSource->id,
                'message' => 'Lead source added successfully.'
            ]);
        }

        return redirect()->route('dashboard.user', auth()->user());
    }

    public function sources()
    {
        $searchString = request('query');

        $sources = LeadSource::query()
            ->where('company_id', auth()->user()->company_id)
            ->where('name', 'like', "%{$searchString}%")
            ->get();

        return $this->respondWithJson(
            (new LeadSourceTransformer())->mapCollection($sources)
        );
    }

    public function destroy(LeadSource $leadSource)
    {
        $this->authorize('destroy', $leadSource);

        $leadSource->delete();

        if (request()->wantsJson()) {
            return $this->respondSuccess(['message' => 'Lead source deleted!']);
        }

        flash('Lead source deleted!', 'success');

        return redirect()->back();
    }
}
