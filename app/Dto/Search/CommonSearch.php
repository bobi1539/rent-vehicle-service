<?php

namespace App\Dto\Search;

class CommonSearch
{
  private $search;
  private $page;
  private $size;

  public function __construct($search, $page = 1, $size = 10)
  {
    $this->search = $search;
    $this->page = $page;
    $this->size = $size;
  }

  public function getSearch()
  {
    return $this->search;
  }

  public function getPage()
  {
    return $this->page;
  }

  public function getSize()
  {
    return $this->size;
  }
}
