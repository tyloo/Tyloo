<?php

namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class UserRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\User';
    }
}
