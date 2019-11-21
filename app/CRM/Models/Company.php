<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $guarded = [];

    public function path()
    {
        return '/companies/' . $this->id;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getAdminAttribute()
    {
        return $this->users()
            ->whereHas('roleUser', function ($roleUser) {
                $roleUser->whereHas('role', function ($role) {
                    $role->whereSlug('admin');
                });
            })
            ->active()
            ->first();
    }

    public function getStatusAttribute()
    {
        if (is_null($this->register_token)) return 'Unverified';

        if ($this->register_token) return 'Active';

        return 'Inactive';
    }

    public function leadSources()
    {
        return $this->hasMany(LeadSource::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
