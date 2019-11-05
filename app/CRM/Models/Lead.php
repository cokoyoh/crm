<?php

namespace CRM\Models;

use CRM\LeadClasses\ChangeLeadClass;
use CRM\Leads\LeadStatus;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use ChangeLeadClass, LeadStatus;

    protected $table = 'leads';

    protected $guarded = [];

    protected $hidden = [
        'first_name',
        'last_name'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function leadAssignee()
    {
        return $this->hasOne(LeadAssignee::class);
    }

    public function leadClass()
    {
        return $this->belongsTo(LeadClass::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function addInteraction(array $attributes)
    {
        return $this->interactions()->create($attributes);
    }

    public function isAssigned(User $user = null)
    {
        $user = $user ?? auth()->user();

        return $this->leadAssignee()
            ->where('lead_id', $this->id)
            ->where('user_id', $user->id)
            ->exists();
    }
}
