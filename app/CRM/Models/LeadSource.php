<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LeadSource extends Model
{
    protected $table = 'lead_sources';

    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::creating(function ($leadSource) {
            $slug =  Str::slug($leadSource->name);

            $alreadyExists = static::whereRaw("slug LIKE '^{$slug}(-[0-9]+)?$'")->count();

            $leadSource->slug = $alreadyExists ? "{$slug}-{$alreadyExists}" : $slug;
        });
    }
}
