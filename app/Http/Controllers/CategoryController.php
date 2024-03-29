<?php

namespace App\Http\Controllers;

use App\Dto\Search\CategorySearch;
use App\Helper\Helper;
use App\Models\Category;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function __construct(
		protected CategoryService $categoryService
	) {
	}

	public function saveCategory(Request $request)
	{
		$validData = $this->validateCategoryRequest($request);
		return $this->categoryService->saveCategory($validData);
	}

	public function updateCategory(Request $request)
	{
		$categoryId = $this->getCategoryId($request);
		$validData = $this->validateCategoryRequest($request);
		return $this->categoryService->updateCategory($categoryId, $validData);
	}

	public function getCategoryById(Request $request)
	{
		$categoryId = $this->getCategoryId($request);
		return $this->categoryService->getCategoryById($categoryId);
	}

	public function getCategoryWithPagination(Request $request)
	{
		$search = $this->getCategorySearch($request);
		return $this->categoryService->getCategoryWithPagination($search);
	}

	public function getCategoryWithoutPagination(Request $request)
	{
		$search = $this->getCategorySearch($request);
		return $this->categoryService->getCategoryWithoutPagination($search);
	}

	public function deleteCategory(Request $request)
	{
		$categoryId = $this->getCategoryId($request);
		return $this->categoryService->deleteCategory($categoryId);
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

	private function getCategoryId(Request $request)
	{
		return Helper::getPathVariable($request->getRequestUri());
	}

	private function getCategorySearch(Request $request)
	{
		$categoryName = "";
		if ($request->has("categoryName")) {
			$categoryName = $request->get("categoryName");
		}

		$page = 1;
		if ($request->has("page")) {
			$page = $request->get("page");
		}

		$size = 10;
		if ($request->has("size")) {
			$size = $request->get("size");
		}

		return new CategorySearch($categoryName, $page, $size);
	}
}
