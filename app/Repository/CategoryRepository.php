<?php

namespace App\Repository;

use App\Dto\Search\CommonSearch;

interface CategoryRepository
{
  public function saveCategory($category);
  public function updateCategory($category);
  public function getCategoryById($categoryId);
  public function getCategoryWithPagination(CommonSearch $search);
  public function getCategoryWithoutPagination(CommonSearch $search);
}
