<?php

namespace App\Http\Controllers;

use App\Helpers\functions;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function register(UserRegisterRequest $request)
    {
        /** @var array $validatedData */
        $validatedData = $request->validated();
        $validatedData ['avatar'] = functions::uploadImage($request->avatar);

        /** @var \App\Models\User $user */
        $user = User::create($validatedData );
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    /**
     * Log in a user and return a JWT token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        /** @var array $credentials */
        $credentials = $request->validated();


        /** @var string|null $token */
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * Respond with a JWT token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
