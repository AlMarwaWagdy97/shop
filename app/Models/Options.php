<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Options extends Model
{
    use HasFactory;

    protected $fillable  = [
        'option_set_id',
        'value',
        'status',
    ];

    //relations
    public function option_set(): BelongsTo
    {
        return $this->belongsTo(OptionSets::class, 'option_set_id');
    }

    public function variance(): BelongsToMany
    {
        return $this->belongsToMany(Variance::class, 'option_variances', 'option_id', 'variance_id');
    }
}
