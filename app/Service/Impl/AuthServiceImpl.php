<?php

namespace App\Service\Impl;

use App\Exceptions\BusinessException;
use App\Service\AuthService;
use App\Service\BaseService;

class AuthServiceImpl extends BaseService implements AuthService
{
  public function login($validData)
  {
    $jwtToken = auth()->attempt($validData);
    if (!$jwtToken) {
      throw new BusinessException(config("message.WRONG_EMAIL_OR_PASSWORD"), 401);
    }
    return $this->buildSuccessResponse($this->responseToken($jwtToken));
  }

  public function logout()
  {
    auth()->logout();
    return $this->buildSuccessResponse();
  }

  public function getUserData()
  {
    $user = auth()->user();
    return $this->buildSuccessResponse($user);
  }

  private function responseToken($token)
  {
    return [
      "access_token" => $token,
      "token_type" => "bearer",
      "expires_in" => 60 * 60
    ];
  }
}
