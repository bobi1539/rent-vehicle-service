<?php

namespace App\Http\Controllers;

use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {
    }

    public function getCategories()
    {
        return ["hello"];
    }

    public function saveCategory(Request $request)
    {
        $validData = $this->validateCategoryRequest($request);
        return $this->categoryService->saveCategory($validData);
    }

    private function validateCategoryRequest(Request $request)
    {
        return $request->validate(
            $this->getRules(),
            $this->getValidationMessage()
        );
    }

    private function getRules()
    {
        return [
            "name" => ["required"],
            "description" => ""
        ];
    }

    private function getValidationMessage()
    {
        return [
            "name.required" => config("message.NAME_IS_REQUIRED")
        ];
    }
}
