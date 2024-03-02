<?php

namespace App\Repository;

class UserRepository
{
    protected $model;

    public function __construct(\Illuminate\Database\Eloquent\Model $model)
    {
        $this->model = $model;
    }
}
