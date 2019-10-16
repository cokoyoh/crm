<?php

namespace CRM\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuperAdmin()
    {
        return $this->checkRole()->exists();
    }

    public function hasRole($role)
    {
        return $this->checkRole($role)->exists();
    }

    private function checkRole($roleSlug = null)
    {
        $roleSlug = $roleSlug ?? 'super_admin';

        return $this->roleUser()
            ->whereHas('role', function ($role) use ($roleSlug){
                $role->where('slug', $roleSlug);
            });
    }

    public function roles()
    {
        return $this->roleUser()
            ->whereHas('role', function ($role) {
                $role->where('user_id', $this->id);
            })
            ->get();
    }

    public function roleUser()
    {
        return $this->hasMany(RoleUser::class);
    }

    public function addRole($roleSlug)
    {
        $role = $this->getRole($roleSlug);

        return $this->roleUser()->create(['role_id' => $role->id]);
    }

    private function getRole($roleSlug)
    {
        return Role::where('slug', $roleSlug)->first();
    }

    public function associateCompany(Company $company)
    {
        $this->company_id = $company->id;

        $this->save();
    }
}
