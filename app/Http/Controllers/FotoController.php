<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class FotoController extends Controller
{
    /**
     * Realiza a autenticação do usuário e retorna o token JWT.
     *
     * @param  \App\Http\Requests\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Renova o token JWT atual.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $newToken = auth()->refresh();

        return $this->respondWithToken($newToken);
    }

    /**
     * Retorna a resposta com o token JWT, seu tipo e tempo de expiração.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ]);
    }
}
