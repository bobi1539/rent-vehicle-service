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

    private function validateLoginRequest(Request $request)
    {
        return $request->validate(
            $this->getRules(),
            $this->getValidationMessage()
        );
    }

    private function getRules()
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
        ];
    }
}
