<?php

namespace Solutionlocale\Commons\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $connection = 'solutionlocale';

    protected $fillable = [
        'name',
    ];

    public function places()
    {
        return $this->hasMany(\Solutionlocale\Commons\Models\Place::class);
    }

    public function users()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\User::class);
    }

    public function rcm()
    {
        return $this->hasMany(\Solutionlocale\Commons\Models\Rcm::class);
    }

    /**
     * Method returning the page title of the object.
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->name . ' - ' . config('app.name', '');
    }

    /**
     * Method for searching places belonging to the region that match keywords.
     * @param string $q
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function searchPlacesByKeyword($q, $sortBy = null, $sortOrder = null)
    {
        $regionId = $this->id;
        $places = Place::searchByKeyword($q, $sortBy, $sortOrder)->filter(function ($place) use ($regionId) {
            return $place->region_id === $regionId;
        });
        return $places;
    }

    /**
     * Method for counting places belonging to the region that match keywords.
     * @param string $q
     * @return int
     */
    public function countPlacesByKeyword($q)
    {
        $places = $this->searchPlacesByKeyword($q);
        return count($places);
    }
}
