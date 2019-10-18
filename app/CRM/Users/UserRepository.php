<?php


namespace CRM\Users;


use CRM\Models\User;
use CRM\RepositoryInterfaces\CreateInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements CreateInterface
{
    protected $user;

    /**
     * UserRepository constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function create(array $attributes)
    {
        $adminNames = processName($attributes['name']);

        return $this->user->create([
            'first_name' => $adminNames[0],
            'last_name' => $adminNames[1],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password'])
        ]);
    }

    public function invite($company, array $attributes)
    {
        $names = processName($attributes['name']);

        $user = $this->user->create([
            'first_name' => $names[0],
            'last_name' => $names[1],
            'email' => $attributes['email']
        ]);

        $user->addRole('user')->addToCompany($company);

        return $user;
    }
}
