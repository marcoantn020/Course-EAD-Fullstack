<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * @throws ValidationException
     */
    public function auth(AuthRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

//        if($request->has('logout_others_devices')) {
//            $user->tokens()->delete();
//        }
        $user->tokens()->delete();
        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'you were logged out'
        ]);
    }

    public function me(): UserResource
    {
        $user = auth()->user();
        return new UserResource($user);
    }
}
