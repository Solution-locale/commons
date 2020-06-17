<?php

namespace Solutionlocale\Commons\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $connection = 'solutionlocale';

    protected $fillable = [
        'url',
        'name',
    ];

    public function places()
    {
        return $this->hasMany(\Solutionlocale\Commons\Models\Place::class);
    }
}
