<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
