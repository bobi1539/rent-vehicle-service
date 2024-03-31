<?php

namespace App\Service\Impl;

use App\Exceptions\BusinessException;
use App\Helper\Helper;
use App\Repository\UserRepository;
use App\Service\AuthService;
use App\Service\BaseService;

class AuthServiceImpl extends BaseService implements AuthService
{

  public function __construct(
    protected UserRepository $userRepository
  ) {
  }

  public function login($validData)
  {
    $user = $this->validateEmailIsExist($validData["email"]);
    $claims = $this->buildClaims($user);
    $jwtToken = auth()->claims($claims)->attempt($validData);
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

  public function register($validData)
  {
    $this->validatePassword($validData["password"], $validData["repeatPassword"]);
    $this->checkEmailIsRegistered($validData["email"]);
    $user = [
      "name" => $validData["name"],
      "email" => $validData["email"],
      "password" => $validData["password"],
      "type" => config("constant.USER_TYPE.CUSTOMER"),
      "created_by" => 1,
      "created_by_name" => $validData["name"],
      "updated_by" => 1,
      "updated_by_name" => $validData["name"],
      "is_deleted" => false
    ];
    $userSaved = $this->userRepository->saveUser($user);
    return $this->buildSuccessResponse($userSaved);
  }

  private function responseToken($token)
  {
    return [
      "access_token" => $token,
      "token_type" => "bearer",
      "expires_in" => 60 * 60
    ];
  }

  private function validatePassword($password, $repeatPassword)
  {
    if (!Helper::isStringContainNumber($password)) {
      throw new BusinessException(config("message.PASSWORD_MUST_CONTAIN_NUMBER"), 400);
    }
    if (!Helper::isStringContainCapitalLetter($password)) {
      throw new BusinessException(config("message.PASSWORD_MUST_CONTAIN_CAPITAL_LETTER"), 400);
    }
    if (!Helper::isStringContainLowerCaseLetter($password)) {
      throw new BusinessException(config("message.PASSWORD_MUST_CONTAIN_LOWER_CASE_LETTER"), 400);
    }
    if (!Helper::isStringContainSymbol($password)) {
      throw new BusinessException(config("message.PASSWORD_MUST_CONTAIN_SYMBOL"), 400);
    }
    if ($password !== $repeatPassword) {
      throw new BusinessException(config("message.REPEAT_PASSWORD_NOT_SAME"), 400);
    }
  }

  private function checkEmailIsRegistered($email)
  {
    $user = $this->getUserByEmail($email);
    if ($user !== null) {
      throw new BusinessException(config("message.EMAIL_IS_REGISTERED"), 400);
    }
  }

  private function getUserByEmail($email)
  {
    return $this->userRepository->getUserByEmail($email);
  }

  private function validateEmailIsExist($email)
  {
    $user = $this->getUserByEmail($email);
    if ($user === null) {
      throw new BusinessException(config("message.WRONG_EMAIL_OR_PASSWORD"), 400);
    }
    return $user;
  }

  private function buildClaims($user)
  {
    return [
      "user_id" => $user->id,
      "name" => $user->name
    ];
  }
}
