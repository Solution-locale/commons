<?php

namespace Solutionlocale\Commons\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'solutionlocale';

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(\Solutionlocale\Commons\Models\Category::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(\Solutionlocale\Commons\Models\Category::class, 'id', 'parent_id');
    }

    public function places()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\Place::class);
    }

    /**
     * Method returning the page title of the object.
     * @return string
     */
    public function getPageTitle(): string
    {
        return $this->name . ' - ' . config('app.name', '');
    }

    public function is_parent_category($parent_id)
    {
        return $this->id === $parent_id;
    }
}
