<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Controllers\Controller;

class AuthenticateController extends Controller
{
    // ______________________________________________________________________________________________________________
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        # code...
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = auth()->user();
        return response()->json(compact('token', 'user'));
    }
    // _______________________________________________________________________________________________________________
    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
    // _____________________________________________________________________________________________________________

    public function refreshToken()
    {
        if (!$token = JWTAuth::getToken())
            return response()->json([
                'error', 'token_not_send'
            ], 401);

        try {
            $token = JWTAuth::refresh();

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }

        return response()->json(compact('token'));
    }
}
