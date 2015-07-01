<?php

namespace App\Repositories\Criteria\Post;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Criteria\Criteria;

class Published extends Criteria
{
    /**
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('published', 1);
    }
}
