<?php

namespace App\Interface;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{
    public function getAllUsers(): Collection;
    public function getUserById(int $userId): ?User;
    public function createUser(array $data): User;
}
