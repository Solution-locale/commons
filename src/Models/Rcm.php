<?php

namespace Solutionlocale\Commons\Models;

use Illuminate\Database\Eloquent\Model;

class Rcm extends Model
{
    protected $connection = 'solutionlocale';

    protected $fillable = [
        'region_id',
        'name',
    ];

    public function region()
    {
        return $this->belongsTo(\Solutionlocale\Commons\Models\Region::class);
    }

    /**
     * Method returning the page title of the object.
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->name . ' - ' . config('app.name', '');
    }
}
