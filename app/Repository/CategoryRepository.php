<?php

namespace App\Repository;

use App\Dto\Search\CategorySearch;

interface CategoryRepository
{
  public function saveCategory($category);
  public function updateCategory($category);
  public function getCategoryById($categoryId);
  public function getCategoryWithPagination(CategorySearch $search);
  public function getCategoryWithoutPagination(CategorySearch $search);
}
