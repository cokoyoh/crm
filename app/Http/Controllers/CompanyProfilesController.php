<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyProfileRequest;
use CRM\Companies\CompanyProfilesRepository;
use CRM\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyProfilesController extends Controller
{
    protected $company;

    /**
     * CompanyProfilesController constructor.
     * @param CompanyProfilesRepository $company
     */
    public function __construct(CompanyProfilesRepository $company)
    {
        $this->company = $company;
    }


    public function complete(Company $company)
    {
        $this->authorize('updateProfile', $company);

        return view('companies.profiles.complete', compact('company'));
    }

    public function store(CompanyProfileRequest $request, Company $company)
    {
        DB::transaction(function () use ($company) {
            $this->company->updateProfile($company, request()->except('_token'));
        });

        return redirect(route('login'));
    }
}
