<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $token = auth('api')->attempt($request->validated());

        if (empty($token)) {
            return response([
                'message' => 'The credentials provided are invalid',
                'errors' => [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->respondWithToken($token);
    }

    private function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
