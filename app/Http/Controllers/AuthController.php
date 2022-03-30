<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Models\Waiter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public static function routeName()
    {
        return Str::snake("Auth");
    }

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        // $user = User::where('U_Name', '=', $request->U_Name)->first();
        $waiter_id = null;
        $pin = $request->WaiterPIN;
        $waiter = Waiter::where('WTR_PIN', '=', $pin)->first();
        // die($waiter);
        if (!$waiter)
            return response()->json(['error' => 'Unauthorized'], 401);
        $waiter_id = $waiter?->WTR_ID;
        // $user->waiter_id = $waiter_id;
        $waiter_token = Crypt::encrypt($waiter_id);
        if ($waiter_token)
            return $this->respondWithToken(null, $waiter_token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function user()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $waiter_token)
    {

        return response()->json([
            'access_token' => $token,
            'waiter_token' => $waiter_token,
            'token_type' =>  'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
