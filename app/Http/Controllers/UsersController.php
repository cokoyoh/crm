<?php

namespace App\Http\Controllers;

use App\Events\Users\UserInvited;
use App\Http\Controllers\Apis\ApiController;
use CRM\Models\Company;
use CRM\Models\User;
use CRM\Transformers\UserTransformer;
use CRM\Users\UserRepository;

class UsersController extends ApiController
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

    public function index()
    {
        $this->authorize('view', new User());

        return view('users.index');
    }

    public function storeInvitedUser(Company $company)
    {
        $this->authorize('manageCompany', $company);

        request()->validate(['name' => 'required', 'email' => 'required|email|unique:users,email']);

        $user = $this->user->invite($company, request()->except('_token'));

        event(new UserInvited($user));

        flash('User invite sent successfully', 'success');

        return redirect()->back();
    }


    public function update(User $user)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $this->user->update($user, request()->except('_token'));

        flash('User updated successfully', 'success');

        return redirect(route('login'));
    }


    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $company = $user->company;

        $this->user->destroy($user);

        flash('User account deleted!', 'success');

        return redirect(route('companies.show', $company));
    }

    public function getCompanyUsers()
    {
        $searchString = request('query');

        $users = User::query()
            ->where('company_id', auth()->user()->company_id)
            ->where('first_name', 'like', "%{$searchString}%")
            ->orWhere('last_name', 'like', "%{$searchString}%")
            ->get();

        return $this->respondWithJson(
            (new UserTransformer())->mapCollection($users)
        );
    }
}
