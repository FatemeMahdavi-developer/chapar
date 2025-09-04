<?php

namespace App\Service;

use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userRepository->getUserById($userId);
    }

    public function createUser(array $data): User
    {
        $user=$this->userRepository->createUser($data);

        $user->token =JWTAuth::fromUser($user);

        return $user;
    }
}
