<?php


namespace Tests\Setup;


use CRM\Models\Role;
use CRM\Models\User;

class UserFactory
{
    protected $roleSlug = 'super_admin';

    public function create()
    {
        $user = create(User::class);

        create(Role::class, ['slug' => $this->roleSlug]);

        $user->addRole($this->roleSlug);

        return $user;
    }

    public function withRole($roleSlug)
    {
        $this->roleSlug = $roleSlug;

        return $this;
    }
}
