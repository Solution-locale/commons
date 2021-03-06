<?php

namespace Solutionlocale\Commons\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Solutionlocale\Commons\Filters\Filterable;

class Place extends Model
{
    use Filterable;
    use LogsActivity;
    use Searchable;

    protected $connection = 'solutionlocale';

    protected $fillable = ['name', 'address', 'address_2', 'province', 'region_id', 'subRegion', 'city', 'countryCode', 'postalCode', 'phoneNumber', 'additionnalPhoneNumber', 'email', 'url', 'facebook_url', 'long', 'lat', 'deliveryZone', 'hide_address', 'rcm_id', 'plus_code', 'is_approved', 'is_closed'];
    protected $hidden = ['long', 'lat',];
    protected $dates = ['normalized_at',];
    protected $touches = ['partner', 'region', 'rcm', 'delivery', 'types', 'categories'];

    // for activity log
    protected static $logFillable = true;
    protected static $logName = 'moderation';
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    protected static function boot()
    {
        parent::boot();

        if (config('soloc-commons.ultra-local.enabled')) {
            static::addGlobalScope(new \Solutionlocale\Commons\Scopes\UltraLocalPlacesScope);
        }
    }

    /**
     * Relationships
     */

    public function rejection()
    {
        return $this->hasOne(\Solutionlocale\Commons\Models\Rejection::class);
    }

    public function partner()
    {
        return $this->belongsTo(\Solutionlocale\Commons\Models\Partner::class);
    }

    public function region()
    {
        return $this->belongsTo(\Solutionlocale\Commons\Models\Region::class);
    }

    public function rcm()
    {
        return $this->belongsTo(\Solutionlocale\Commons\Models\Rcm::class);
    }

    public function categories()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\Category::class);
    }

    public function types()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\PlaceType::class);
    }

    public function delivery()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\DeliveryType::class);
    }

    /**
     * Scopes
     */

    public function scopeOpened($query)
    {
        return $query->where('is_closed', 0);
    }

    /**
     * Custom methods
     */

    public function getCompleteAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->province}, {$this->postalCode}";
    }

    /**
     * Method returning the page title of the object.
     * @return string
     */
    public function getPageTitle(): string
    {
        $midName = @$this->region->name ? " - {$this->region->name} - " : ' - ';
        return "{$this->name}{$midName}" . config('app.name', '');
    }

    /**
     * Method for search places by keywords.
     * @param string $q
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function searchByKeyword($q, $sortBy = null, $sortOrder = null)
    {
        $like = '%' . str_replace(' ', '%', $q) . '%';
        $search = 'is_approved and rejection_id IS NULL and (name like ? or address like ? or city like ?)';
        $bindings = [$like, $like, $like];

        $sortBy = $sortBy ?? 'name';
        $sortOrder = $sortOrder ?? 'asc';
        return parent::whereRaw($search, $bindings)->orderBy($sortBy, $sortOrder)->get();
    }

    /**
     * Method for counting places corresponding some keywords.
     * @param string $q
     * @return int
     */
    public static function countByKeyword($q)
    {
        $places = self::searchByKeyword($q);
        return count($places);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        switch ($eventName) {
            case 'created':
                $eventNameFrench = 'créée';
                break;

            case 'updated':
                $eventNameFrench = 'mise à jour';
                break;

            case 'deleted':
                $eventNameFrench = 'détruite';
                break;
        }

        return "Cette fiche à été {$eventNameFrench}.";
    }

    public function shouldBeSearchable()
    {
        return $this->is_approved && !$this->is_closed;
    }

    public function toSearchableArray()
    {
        /**
         * Load the categories relation so that it's
         * available in the Laravel toArray() method
         */

        $this->delivery;
        $this->types;
        $this->categories;

        $array = $this->toArray();

        // Applies Scout Extended default transformations:
        $array = $this->transform($array);

        // Add an extra attribute:
        $array['mrc'] = optional($this->rcm)->name;
        $array['region'] = optional($this->region)->name;
        $array['partner'] = optional($this->partner)->name;
        $array['delivery'] = $this->delivery->map(function ($data) {
            return $data['name'];
        })->toArray();
        $array['types'] = $this->types->map(function ($data) {
            return $data['name'];
        })->toArray();
        $array['categories'] = $this->categories->map(function ($data) {
            return $data['name'];
        })->toArray();

        if ($this->lat !== null && !$this->long !== null) {
            $array['_geoloc'] = [
                'lat' => $this->lat,
                "lng" => $this->long
            ];
        }


        return $array;
    }
}
