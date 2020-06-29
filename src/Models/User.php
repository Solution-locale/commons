<?php

namespace Solutionlocale\Commons\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * This model will always correspond to the main Solution Locale website users.
 * It will have to be aliased if used in context of ultra local apps amongst another User model.
 */

class User extends Authenticatable
{
    use Notifiable;
    use CanResetPassword;
    use HasRoles;
    use CausesActivity;

    public function __construct()
    {
        $this->connection = config("soloc-commons.users.db-connection");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_notifiable'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rejections()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\Rejection::class);
    }

    public function regions()
    {
        return $this->belongsToMany(\Solutionlocale\Commons\Models\Region::class);
    }
}
