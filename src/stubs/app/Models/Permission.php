<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permission
 * @package App\Models
 */
class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'name', 'description'
    ];

    /**
     * The "boot" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::saving(function ($permission) {
            cache()->forget('permissions.name');
        });

        self::deleting(function ($permission) {
            cache()->forget('permissions.name');
        });

        //
    }

    #########################
    ####  RELATIONSHIPS  ####
    #########################

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    #########################
    ####     SCOPES      ####
    #########################

    //

    #########################
    ####    MUTATORS     ####
    #########################

    //

    #########################
    ####    ACCESSORS    ####
    #########################

    //

    #########################
    ####     METHODS     ####
    #########################

    //
}
