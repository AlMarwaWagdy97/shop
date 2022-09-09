<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PhpOption\Option;

class Variance extends Model
{
    use HasFactory;

    protected $fillable  = [
        'product_id',
        'title',
        'price',
        'stock',
        'is_in_stock',
        'status',
    ];

    protected $appends = ['stock_status'];


    /* Accessors & Mutators */
    public function getStockStatusAttribute(){
        return ProductStatusEnum::StatusName($this->is_in_stock);
    }

    public function getOption1Attribute(){
        $option = $this->options->first();
        if($option == null)return "";
        return   @$this->options->first()->option_set->name  . " : " .  @$option->value;
    }
    public function getOption2Attribute(){
        if(count($this->options) > 1){
            $option = $this->options->last();
            return   @$this->options->last()->option_set->name  . " : " .  @$option->value;
        }
        return "";
    }


    //relations
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Options::class, 'option_variances', 'variance_id', 'option_id')->orderBy('id');
    }
}
