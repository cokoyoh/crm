<?php

namespace CRM\Models;

use CRM\LeadClasses\ChangeLeadClass;
use CRM\Leads\ExpungesLead;
use CRM\Leads\LeadConversion;
use CRM\Leads\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes,
        ExpungesLead,
        ChangeLeadClass,
        LeadStatus,
        LeadConversion;

    protected $table = 'leads';

    protected $guarded = [];

    protected $hidden = [
        'first_name',
        'last_name'
    ];

    protected $appends = [
        'name'
    ];

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

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

    public function assign(User $user)
    {
        $this->leadAssignee()->delete();

        return $this->leadAssignee()->create(['user_id' => $user->id]);
    }

    public function isAssigned(User $user = null)
    {
        $user = $user ?? auth()->user();

        return $this->leadAssignee()
            ->where('lead_id', $this->id)
            ->where('user_id', $user->id)
            ->exists();
    }

    public function notes()
    {
        return $this->hasOne(LeadNote::class);
    }

    public function addNotes(array $input)
    {
        if ($this->notes) {
            $this->notes()->update($input);

            return $this->notes->fresh();
        }

        return $this->notes()->create($input);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function scopeConverted($query)
    {
        return $query
            ->has('contact')
            ->orwhereHas(
                'leadClass',
                function ($leadClass) {
                    $leadClass->where('slug', 'converted');
                });
    }

    public function scopeLost($query)
    {
        return $query->whereHas('leadClass', function ($leadClass) {
            $leadClass->where('slug', 'lost');
        });
//        return $query->whereHas(
//                'leadClass',
//            function ($leadClass) {
//                $leadClass->where('slug', 'lost');
//            });
    }
}
