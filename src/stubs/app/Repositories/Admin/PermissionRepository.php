<?php

namespace App\Repositories\Admin;

use App\Models\Permission;
use LuizHenriqueBK\LaravelRepository\Repository;

/**
 * Class PermissionRepository.
 * @package App\Repositories\Admin
 */
class PermissionRepository extends Repository
{
    /**
     * @var $model
     */
    protected $model = Permission::class;
}
