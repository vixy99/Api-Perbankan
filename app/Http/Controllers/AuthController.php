<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','refresh']]);
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
        $data = User::where('email',$credentials['email'])->first();
        $data->refresh_token = Str::random(100);
        $data->save();
        return $this->respondWithToken($token, $data->refresh_token);
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

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $data = User::where('email',auth()->user()->email)->first();
        $data->refresh_token = null;
        $data->save();
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        if( request(['token']) == null ) {
            return response()->json([
                'message' => 'Refresh Token Not Define'
            ],500);
        }
        $credentials = request(['token']);
        $data = User::where('refresh_token',$credentials['token'])->first();
        if( $data === null){
            return response()->json([
                'message' => 'Refresh Token Not Valid'
            ],500);
        }
        $token = auth()->login($data);
        return $this->respondWithToken($token, $data->refresh_token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $refreshToken)
    {
        return response()->json([
            'accessToken' => $token,
            'refreshToken' => $refreshToken            
        ]);
    }

}

