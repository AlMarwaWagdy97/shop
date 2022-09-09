<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpOption\Option;

class OptionSets extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name',
        'status',
    ];


    //relations
    public function variance(): HasMany
    {
        return $this->hasMany(Option::class);
    }


    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'option_set_products', 'option_set_id', 'product_id');
    }
}
