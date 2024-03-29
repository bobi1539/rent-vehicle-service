<?php

namespace App\Helper;

class Helper
{
  public static function getPathVariable($requestUri)
  {
    $arr = explode("/", $requestUri);
    return $arr[count($arr) - 1];
  }
}
