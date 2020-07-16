<?php

namespace App\Repositories\Admin;

use App\Models\Role;
use LuizHenriqueBK\LaravelRepository\Repository;

/**
 * Class RoleRepository.
 * @package App\Repositories\Admin
 */
class RoleRepository extends Repository
{
    /**
     * @var $model
     */
    protected $model = Role::class;
}
