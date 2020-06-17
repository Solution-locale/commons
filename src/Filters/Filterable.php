<?php

namespace Solutionlocale\Commons\Filters;

use Illuminate\Database\Eloquent\Builder;
use Solutionlocale\Commons\Filters\QueryFilter;

trait Filterable
{
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
