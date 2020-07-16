<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    #########################
    ####  RELATIONSHIPS  ####
    #########################

    /**
     * A user may have one media.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function avatar()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->with(['permissions']);
    }

    #########################
    ####     SCOPES      ####
    #########################

    //

    #########################
    ####    MUTATORS     ####
    #########################

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = Hash::needsRehash($password) ?
                Hash::make($password) : $password;
        }
    }

    #########################
    ####    ACCESSORS    ####
    #########################

    //

    #########################
    ####     METHODS     ####
    #########################

    /**
     * Determine if the user is Administrator.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->hasRole('administrator');
    }

    /**
     * A user may have multiple Permission.
     *
     * @return array
     */
    public function permissions()
    {
        return $this->roles->pluck('permissions')->collapse();
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->permissions()->contains('name', $permission);
        }
        return !! $permission->intersect($this->permissions)->count();
    }
}
