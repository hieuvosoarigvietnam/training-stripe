<?php

namespace App\Services\Auth;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class LoginService
{
    /**
     * Handle login and return the token
     *
     * @throws \Exception
     */
    public function handle($request)
    {
        $attrs = $request->all();
        $token = auth()->attempt($attrs);

        if (!$token) {
            throw new Exception(__('auth.failed'), Response::HTTP_UNAUTHORIZED);
        }

        return $this->_getToken($request);
    }

    /**
     * Handle to issue Bearer Token
     *
     * @return mixed
     */
    private function _getToken($request)
    {
        $device = $request->userAgent();
        $user = auth()->user();

        return $user->createToken($device)->plainTextToken;
    }
}
