<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OptionSetProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'option_set_id',
    ];



    //relations
    public function option_set(): BelongsTo
    {
        return $this->belongsTo(OptionSets::class, 'option_set_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

}
