<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => ['required', 'regex:/(^(\+98|0098|98|0)9\d{9}$)/'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        $mobile = '0' . substr($fields['mobile'], -10, 10);

        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'mobile' => $mobile,
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        return response($user, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $user = User::whereEmail($fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        return $user->createToken('todolist')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return true;
    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
