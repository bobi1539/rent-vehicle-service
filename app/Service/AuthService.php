<?php

namespace App\Service;

interface AuthService
{
  public function login($validData);
  public function logout();
  public function getUserData();
  public function register($validData);
}
