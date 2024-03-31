<?php

namespace App\Http\Controllers;

use App\Service\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(
        protected AuthService $authService
    ) {
    }

    public function login(Request $request)
    {
        $validData = $this->validateLoginRequest($request);
        return $this->authService->login($validData);
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function getUserData()
    {
        return $this->authService->getUserData();
    }

    public function register(Request $request)
    {
        $validData = $this->validateRegisterRequest($request);
        return $this->authService->register($validData);
    }

    private function validateLoginRequest(Request $request)
    {
        return $request->validate(
            $this->getLoginRules(),
            $this->getValidationMessage()
        );
    }

    private function getLoginRules()
    {
        return [
            "email" => ["required", "email"],
            "password" => ["required"]
        ];
    }

    private function getValidationMessage()
    {
        return [
            "email.required" => config("message.EMAIL_IS_REQUIRED"),
            "email.email" => config("message.EMAIL_NOT_VALID"),
            "password.required" => config("message.PASSWORD_IS_REQUIRED"),
            "password.min" => config("message.PASSWORD_MIN"),
            "name.required" => config("message.NAME_IS_REQUIRED"),
            "repeatPassword.required" => config("message.REPEAT_PASSWORD_IS_REQUIRED")
        ];
    }

    private function getRegisterRules()
    {
        return [
            "email" => ["required", "email"],
            "password" => ["required", "min:8"],
            "name" => ["required"],
            "repeatPassword" => ["required"]
        ];
    }

    private function validateRegisterRequest(Request $request)
    {
        return $request->validate(
            $this->getRegisterRules(),
            $this->getValidationMessage()
        );
    }
}
