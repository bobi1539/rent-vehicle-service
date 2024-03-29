<?php

namespace App\Service\Impl;

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
}
