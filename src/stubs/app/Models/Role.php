<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 */
class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'name', 'description'
    ];

    #########################
    ####  RELATIONSHIPS  ####
    #########################

    /**
     * A user can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
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
