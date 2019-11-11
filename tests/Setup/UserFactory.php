<?php


namespace Tests\Setup;


use CRM\Models\Company;
use CRM\Models\Role;
use CRM\Models\User;

class UserFactory
{
    protected $roleSlug = 'super_admin';

    protected $company = null;

    public function create(array $attributes = [])
    {
        $attributes['company_id'] = $this->company ? $this->company->id : null;

        $user = create(User::class, $attributes);

        create(Role::class, ['slug' => $this->roleSlug]);

        $user->addRole($this->roleSlug);

        $this->company = null;

        return $user;
    }

    public function superAdmin()
    {
        return $this->withRole('super_admin');
    }

    public function admin()
    {
        return $this->withRole('admin');
    }

    public function regularUser()
    {
        return $this->withRole('user');
    }

    public function withRole($roleSlug)
    {
        $this->roleSlug = $roleSlug;

        return $this;
    }

    public function fromCompany($company = null)
    {
        $this->company = $company ? $company : create(Company::class);

        return $this;
    }
}
