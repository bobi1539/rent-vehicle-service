<?php

namespace App\Service\Impl;

use App\Dto\Search\CategorySearch;
use App\Exceptions\BusinessException;
use App\Repository\CategoryRepository;
use App\Service\BaseService;
use App\Service\CategoryService;

class CategoryServiceImpl extends BaseService implements CategoryService
{

  public function __construct(
    protected CategoryRepository $categoryRepository
  ) {
  }

  public function saveCategory($validData)
  {
    $category = $this->getCreatedData();
    $category["name"] = $validData["name"];
    $category["description"] = $validData["description"];
    $categorySaved = $this->categoryRepository->saveCategory($category);
    return $this->buildSuccessResponse($categorySaved);
  }

  public function updateCategory($categoryId, $validData)
  {
    $category = $this->findCategoryById($categoryId);
    $category["name"] = $validData["name"];
    $category["description"] = $validData["description"];
    $this->categoryRepository->updateCategory($category);
    return $this->buildSuccessResponse($category);
  }

  public function getCategoryById($categoryId)
  {
    return $this->buildSuccessResponse($this->findCategoryById($categoryId));
  }

  public function getCategoryWithPagination(CategorySearch $search)
  {
    $categories = $this->categoryRepository->getCategoryWithPagination($search);
    return $this->buildSuccessResponse($categories);
  }

  public function getCategoryWithoutPagination(CategorySearch $search)
  {
    $categories = $this->categoryRepository->getCategoryWithoutPagination($search);
    return $this->buildSuccessResponse($categories);
  }

  public function deleteCategory($categoryId)
  {
    $category = $this->findCategoryById($categoryId);
    $category["is_deleted"] = true;
    $this->categoryRepository->updateCategory($category);
    return $this->buildSuccessResponse();
  }

  private function findCategoryById($categoryId)
  {
    $category = $this->categoryRepository->getCategoryById($categoryId);
    if ($category == null) {
      throw new BusinessException(config("message.DATA_NOT_FOUND"), 400);
    }
    return $category->getAttributes();
  }
}
