<?php

namespace App\Service;

use App\Dto\Search\CategorySearch;

interface CategoryService
{
  public function saveCategory($validData);
  public function updateCategory($categoryId, $validData);
  public function getCategoryById($categoryId);
  public function getCategoryWithPagination(CategorySearch $search);
  public function getCategoryWithoutPagination(CategorySearch $search);
  public function deleteCategory($categoryId);
}
