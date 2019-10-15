<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
   public function sendResponse($result ,$message) {
      $response = [
        'data' => $result,
        'status'=> true,
        'message' => $message,
      ];

      return response()->json($response, 200);
   }

   public function sendError($result, $message) {

       $response = [
          'data' => null,
         'status'=> false,
         'message' => $message,
    ];
  

    return response()->json($response, 404);

  }
}
