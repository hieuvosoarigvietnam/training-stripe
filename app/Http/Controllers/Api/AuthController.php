<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Login and handle the issuance of a Bearer Token by Sanctum.
     *
     * @param Request $request
     * @param LoginService $service
     * @return JsonResponse
     * @throws \Exception
     */
    public function login(Request $request, LoginService $service)
    {
        $token = $service->handle($request);

        return responseSuccess(__('messages.request.success.login'), $token);
    }

    /**
     * Logging out of the current session and revoking all the tokens.
     *
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        auth()->guard('web')->logout();

        return responseSuccess(__('messages.request.success.logout'));
    }

    /**
     * Retrieve the current user account.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request)
    {
        return responseSuccess(__('messages.request.success.common'), auth()->user());
    }
}
