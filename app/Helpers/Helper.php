<?php

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('responseSuccess')) {
    /**
     * Get the response success.
     *
     * @param string $message
     * @param null $data
     * @param int $code
     * @return JsonResponse
     */
    function responseSuccess(string $message = '', $data = null, int $code = Response::HTTP_OK)
    {
        // Custom response file
        $res = [
            "message" => $message,
            "status" => $code,
            'data' => $data
        ];

        return response()->json($res);
    }
}

if (!function_exists('responseError')) {
    /**
     * Get the response error.
     *
     * @param string $msg
     * @param int $code
     * @return JsonResponse
     */
    function responseError(string $msg = '', int $code = Response::HTTP_BAD_REQUEST)
    {
        $response = ['message' => $msg, 'status' => $code];

        return response()->json($response, $code);
    }
}

if (!function_exists('customThrowException')) {
    /**
     * Customize exception.
     *
     * @param string $msg
     * @param int $code
     * @return mixed
     * @throws Exception
     */
    function customThrowException(string $msg = '', int $code = Response::HTTP_BAD_REQUEST): mixed
    {
        throw new Exception($msg, $code);
    }
}
