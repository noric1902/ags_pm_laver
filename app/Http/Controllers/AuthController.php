<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    protected function respondWithToken($token) {
        return response([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response([
                    'status'    => 'error',
                    'error'     => 'invalid.credentials',
                    'msg'       => 'Invalid Credentials!'
                ], Response::HTTP_BAD_REQUEST);
            }

            return response([
                'status'    => 'success',
            ])->header('Authorization', $token);

            // return $this->respondWithToken($token);
        } catch (JWTException $e) {
            return response([
                'status'    => 'error',
                'error'     => 'internal.error',
                'msg'       => 'Something went wrong!'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function user(Request $request) {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh() {
        return response([
            'status' => 'success'
        ]);
    }

    public function guard() {
        return Auth::guard();
    }

    public function logout() {
        JWTAuth::invalidate();
        return response([
            'status'    => 'success',
            'msg'       => 'Successfully logged out!',
        ], Response::HTTP_OK);
    }
}
