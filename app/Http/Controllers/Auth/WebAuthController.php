<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WebAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return response('', Response::HTTP_OK);
        }

        return response([
            'message' => 'The credentials provided are invalid',
            'errors' => [],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function logout()
    {
        auth()->logout();
    }
}
