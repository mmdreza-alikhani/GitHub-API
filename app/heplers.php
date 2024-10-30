<?php

use Illuminate\Http\JsonResponse;

function errorResponse($code, $message = 'Error'): JsonResponse
{

    return response()->json([

        'status' => 'Error',

        'message' => $message,

        'data' => ""

    ], $code);

};

function successResponse($data,$code,$message = null): JsonResponse
{

    return response()->json([

        'status' => 'Success',

        'message' => $message,

        'data' => $data

    ], $code);

}
