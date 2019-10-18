<?php

namespace App\Http\Controllers;

use App\Events\Users\UserInvited;
use CRM\Models\Company;
use CRM\Users\UserRepository;

class UsersController extends Controller
{
    public $user;

    /**
     * UsersController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    public function invite(Company $company)
    {
        return view('companies.users.invite', compact('company'));
    }


    public function storeInvitedUser(Company $company)
    {
        $this->authorize('manageCompany', $company);

        request()->validate(['name' => 'required', 'email' => 'required|email|unique:users,email']);

        $user = $this->user->invite($company, request()->except('_token'));

        event(new UserInvited($user));

        return redirect(route('companies.show', $company));
    }
}
