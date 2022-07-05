<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends \App\Http\Controllers\Controller
{
    /**
     * @throws ValidationException
     */
    public function register(Request $request): array
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::query()->where('email', $request->email)->first();
        if ($user !== null) {
            throw ValidationException::withMessages(['email' => ['The email is exists.']]);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user->save()) {
            throw new \Exception('Error create user.');
        }

        $token = $user->createToken('api');

        return [
            'token' => $token->plainTextToken,
            'expiration' => config('sanctum.expiration'),
        ];
    }
    /**
     * @throws ValidationException
     */
    public function login(Request $request): array
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::query()->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api');

        return [
            'token' => $token->plainTextToken,
            'expiration' => config('sanctum.expiration'),
        ];
    }

    /**
     * @throws ValidationException
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
