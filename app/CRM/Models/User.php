<?php

namespace CRM\Models;

use CRM\Users\UserLeadsCount;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, UserLeadsCount;

    protected $appends = [
        'name', 'status'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'first_name', 'last_name', 'email', 'password', 'deactivated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'first_name', 'last_name'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deactivated_at' => 'datetime'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getStatusAttribute()
    {
        return $this->deactivated_at ? 'Inactive' : 'Active';
    }

    public function isSuperAdmin()
    {
        return $this->checkRole()->exists();
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
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

        $this->roleUser()->create(['role_id' => $role->id]);

        return $this;
    }

    private function getRole($roleSlug)
    {
        return Role::where('slug', $roleSlug)->first();
    }

    public function addToCompany(Company $company)
    {
        $this->update([
            'company_id' => $company->id
        ]);

        return $this;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeActive($query, $condition = true)
    {
        if (!$condition) {
            return $query->whereNotNull('deactivated_at');
        }

        return $query->whereNull('deactivated_at');
    }

    public function leads()
    {
        return Lead::whereHas(
            'leadAssignee',
            function ($leadAssignee) {
                $leadAssignee->where('user_id', $this->id);
            })
            ->latest()
            ->get();
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
