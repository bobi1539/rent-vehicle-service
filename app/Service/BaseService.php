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
    $user = $this->getUserFromToken();
    return [
      "created_at" => Carbon::now()->timestamp,
      "created_by" => $user["id"],
      "created_by_name" => $user["name"],
      "updated_at" => Carbon::now()->timestamp,
      "updated_by" => $user["id"],
      "updated_by_name" => $user["name"],
      "is_deleted" => false
    ];
  }

  protected function getUserFromToken()
  {
    $payload = auth()->payload();
    return [
      "id" => $payload["user_id"],
      "name" => $payload["name"]
    ];
  }
}
