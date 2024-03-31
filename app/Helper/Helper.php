<?php

namespace App\Helper;

class Helper
{
  public static function getPathVariable($requestUri)
  {
    $arr = explode("/", $requestUri);
    return $arr[count($arr) - 1];
  }

  public static function isStringContainNumber($value)
  {
    return preg_match('/\d/', $value) === 1;
  }

  public static function isStringContainCapitalLetter($value)
  {
    return preg_match('/[A-Z]/', $value) === 1;
  }

  public static function isStringContainLowerCaseLetter($value)
  {
    return preg_match('/[a-z]/', $value) === 1;
  }

  public static function isStringContainSymbol($value)
  {
    return preg_match('/[^a-zA-Z0-9\s]/', $value) === 1;
  }
}
