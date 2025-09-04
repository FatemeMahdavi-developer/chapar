<?php

namespace App\Repository;

use App\Interface\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAllUsers() :Collection
    {
        return $this->model->all();
    }

    public function getUserById(int $id) :?User
    {
        return $this->model->find($id);
    }

    public function createUser(array $data): User
    {
        return $this->model->create($data);
    }

}
