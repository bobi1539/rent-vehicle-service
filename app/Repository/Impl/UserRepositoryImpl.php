<?php

namespace App\Repository\Impl;

use App\Models\User;
use App\Repository\UserRepository;

class UserRepositoryImpl implements UserRepository
{
  public function saveUser($user)
  {
    return User::create($user);
  }

  public function getUserByEmail($email)
  {
    return User::where([
      ["email", "=", $email],
      ["is_deleted", "=", false]
    ])->first();
  }
}
