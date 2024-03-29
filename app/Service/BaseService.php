<?php

namespace App\Service;

use Carbon\Carbon;

abstract class BaseService
{

  protected function buildSuccessResponse($data = [])
  {
    return [
      "code" => 200,
      "message" => "Success | Sukses",
      "data" => $data
    ];
  }

  protected function getCreatedData()
  {
    return [
      "created_at" => Carbon::now()->timestamp,
      "created_by" => 1,
      "created_by_name" => "system",
      "updated_at" => Carbon::now()->timestamp,
      "updated_by" => 1,
      "updated_by_name" => "system",
      "is_deleted" => false
    ];
  }
}
