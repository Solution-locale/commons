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

    protected static function boot()
    {
        parent::boot();

        if (config('soloc-commons.ultra-local.enabled')) {
            static::addGlobalScope(new \Solutionlocale\Commons\Scopes\UltraLocalRCMsScope);
        }
    }

    public function places()
    {
        return $this->hasMany(\Solutionlocale\Commons\Models\Place::class);
    }

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
