<?php

namespace App\Repository;

interface UserRepository
{
  public function saveUser($user);
  public function getUserByEmail($email);
}
