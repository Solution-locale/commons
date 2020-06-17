<?php

namespace Solutionlocale\Commons\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    protected $connection = 'solutionlocale';

    protected $fillable = [
        'name',
    ];

    public function places()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\Place::class);
    }
}
