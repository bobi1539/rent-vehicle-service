<?php

namespace App\Repository\Impl;

use App\Dto\Search\CategorySearch;
use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryRepositoryImpl implements CategoryRepository
{
  public function saveCategory($category)
  {
    return Category::create($category);
  }

  public function updateCategory($category)
  {
    return Category::where("id", $category["id"])->update($category);
  }

  public function getCategoryById($categoryId)
  {
    return Category::where([
      ["id", "=", $categoryId],
      ["is_deleted", "=", false]
    ])->first();
  }

  public function getCategoryWithPagination(CategorySearch $search)
  {
    return Category::where($this->getCondition($search))
      ->paginate($search->size)
      ->withQueryString();
  }

  public function getCategoryWithoutPagination(CategorySearch $search)
  {
    return Category::where($this->getCondition($search))->get();
  }

  private function getCondition(CategorySearch $search)
  {
    $condition = [
      ["is_deleted", "=", false]
    ];

    if ($search->categoryName != "") {
      $condition = ["name", "like", "%" . $search->categoryName . "%"];
    }
    return $condition;
  }
}
