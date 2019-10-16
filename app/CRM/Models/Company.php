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
}
