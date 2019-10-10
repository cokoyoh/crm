<?php

namespace Tests;

use CRM\Models\Role;
use CRM\Models\RoleUser;
use CRM\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null, $role = null)
    {
        $user = $user ?? create(User::class);

        $this->addRole($user, $role);

        $this->actingAs($user);

        return $user;
    }

    public function signInWithRole($role = null)
    {
        $user = create(User::class);

        $this->addRole($user, $role);

        $this->actingAs($user);

        return $user;
    }

    protected function addRole(User $user, $role = null)
    {
        if (is_null($role)) return;

        $role = create(Role::class, ['slug' => $role]);

        create(RoleUser::class, ['user_id' => $user->id, 'role_id' => $role->id]);
    }
}
