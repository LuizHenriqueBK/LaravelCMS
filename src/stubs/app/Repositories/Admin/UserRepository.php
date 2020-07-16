<?php

namespace App\Repositories\Admin;

use App\Models\User;
use LuizHenriqueBK\LaravelRepository\Repository;

/**
 * Class UserRepository.
 * @package App\Repositories\Admin
 */
class UserRepository extends Repository
{
    /**
     * @var $model
     */
    protected $model = User::class;
}
