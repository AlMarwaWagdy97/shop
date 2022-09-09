<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable  = [
        'title',
        'is_in_stock',
        'average_rating',
        'default_variant',
        'status',
    ];

    protected $appends = ['stock_status'];

    /* Accessors & Mutators */
    public function getStockStatusAttribute(){
        return ProductStatusEnum::StatusName($this->is_in_stock);
    }


    //relations
    public function variance(): HasMany
    {
        return $this->hasMany(Variance::class, 'product_id');
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(OptionSets::class, 'option_set_products', 'product_id', 'option_set_id');
    }


    //functions
    public function defaultVariation(){
        return Variance::find($this->default_variant);
    }
}
