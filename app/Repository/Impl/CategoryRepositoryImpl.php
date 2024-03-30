<?php

namespace App\Repository\Impl;

use App\Dto\Search\CommonSearch;
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

  public function getCategoryWithPagination(CommonSearch $search)
  {
    return Category::where($this->isDeletedFalse())
      ->whereAny(
        ["name", "description"],
        "like",
        "%" . $search->getSearch() . "%"
      )
      ->paginate($search->getSize())
      ->withQueryString();
  }

  public function getCategoryWithoutPagination(CommonSearch $search)
  {
    return Category::where($this->isDeletedFalse())
      ->whereAny(
        ["name", "description"],
        "like",
        "%" . $search->getSearch() . "%"
      )->get();
  }

  private function isDeletedFalse()
  {
    return [
      ["is_deleted", "=", false]
    ];
  }
}
