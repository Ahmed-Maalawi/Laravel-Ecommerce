<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin')->except('login');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'login successfully',
            'user' => auth('admin')->user(),
            'authentication' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('admin')->factory()->getTTL().' minutes',
            ],
        ]);

//        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get current user',
            'data' => auth('admin')->user(),
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth('admin')->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully log out',
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
//        return $this->respondWithToken(auth()->refresh());

        return response()->json([
            'status' => 'success',
            'message' => 'token updated successfully',
            'data' => [
                'access_token' => auth('admin')->refresh(),
                'token_type' => 'bearer',
                'expires_in' => auth('admin')->factory()->getTTL().' minutes',
            ]
        ]);
    }

    /**
     * Get the token array structure.
     *
    //     * @param  string $token
     *
    //     * @return \Illuminate\Http\JsonResponse
     */
//    protected function respondWithToken($token)
//    {
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'expires_in' => auth()->factory()->getTTL() * 60
//        ]);
//    }
}
