<?php

namespace App\Service;

use App\Dto\Search\CommonSearch;

interface CategoryService
{
  public function saveCategory($validData);
  public function updateCategory($categoryId, $validData);
  public function getCategoryById($categoryId);
  public function getCategoryWithPagination(CommonSearch $search);
  public function getCategoryWithoutPagination(CommonSearch $search);
  public function deleteCategory($categoryId);
}
