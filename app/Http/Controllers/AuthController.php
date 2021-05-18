<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => ['required', 'regex:/(^(\+98|0098|98|0)9\d{9}$)/'],
            'email' => 'required|email',
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
}
