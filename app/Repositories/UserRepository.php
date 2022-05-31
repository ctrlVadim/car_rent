<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public function findOne(int $id): User
    {
        return User::where('id', $id)->first();
    }
}
