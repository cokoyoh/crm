<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';

    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::creating(function ($product) {
            $slug =  Str::slug($product->name);

            $alreadyExists = static::whereRaw("slug LIKE '^{$slug}(-[0-9]+)?$'")->count();

            $product->slug = $alreadyExists ? "{$slug}-{$alreadyExists}" : $slug;
        });
    }
}
