<?php

namespace App\Http\Controllers;

use App\Events\Users\UserInvited;
use CRM\Models\Company;
use CRM\Models\User;
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


    public function profile(User $user)
    {
        $this->authorize('completeProfile', $user);

        return view('users.profile', compact('user'));
    }


    public function invite(Company $company)
    {
        $this->authorize('manageCompany', $company);

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


    public function update(User $user)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $this->user->update($user, request()->except('_token'));

        return redirect(route('login'));
    }
}
