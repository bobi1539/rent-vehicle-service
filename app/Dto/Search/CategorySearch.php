<?php

namespace App\Dto\Search;

class CategorySearch
{
  public $categoryName;
  public $page;
  public $size;

  public function __construct($categoryName, $page = 1, $size = 10)
  {
    $this->categoryName = $categoryName;
    $this->page = $page;
    $this->size = $size;
  }
}
