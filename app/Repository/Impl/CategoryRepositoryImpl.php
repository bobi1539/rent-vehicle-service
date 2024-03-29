<?php

namespace App\Repository\Impl;

use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryRepositoryImpl implements CategoryRepository
{
  public function saveCategory($category)
  {
    return Category::create($category);
  }
}
