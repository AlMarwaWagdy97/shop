<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOption\Option;

class OptionVariance extends Model
{
    use HasFactory;
    protected $fillable = [
        'variance_id',
        'option_id',
    ];



    //relations
    public function option(): BelongsTo
    {
        return $this->belongsTo(Options::class, 'variance_id');
    }

    public function variance(): BelongsTo
    {
        return $this->belongsTo(Variance::class, 'option_id');
    }
}
