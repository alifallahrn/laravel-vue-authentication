<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => ['required', 'regex:/(^(\+98|0098|98|0)9\d{9}$)/'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
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

    public function forgot(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink($fields);

        if ($status === Password::RESET_LINK_SENT) {
            return response('The password reset link was emailed to you', 200);
        }

        throw ValidationException::withMessages([
            'forgot' => ['An error occurred. Please try again']
        ]);
    }

    public function reset(Request $request)
    {
        $fields = $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset($fields, function ($user, $password) use ($request) {
            $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        });

        if ($status == Password::PASSWORD_RESET) {
            return response(true, 200);
        }

        throw ValidationException::withMessages([
            'reset' => ['An error occurred. Please try again']
        ]);
    }
}
