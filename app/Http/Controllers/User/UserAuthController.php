<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'login successfully',
            'user' => auth()->user(),
            'authentication' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL().' minutes',
            ],
        ]);

//        return $this->respondWithToken($token);
    }

    public function register(StoreUserRequest $request)
    {

        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['name']),
        ]);

        if (!  $user) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'user not added !',
            ], 400));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'user created successfully',
            'data' => $user,
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'get current user',
            'data' => auth()->user(),
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
//        return $this->respondWithToken(auth()->refresh());

        return response()->json([
            'status' => 'success',
            'message' => 'token updated successfully',
            'data' => [
                'access_token' => auth()->refresh(),
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL().' minutes',
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
