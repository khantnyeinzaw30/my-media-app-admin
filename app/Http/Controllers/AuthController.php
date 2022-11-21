<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // admin login view
    public function loginView()
    {
        return view('auth.login');
    }

    // admin register view
    public function registerView()
    {
        return view('auth.register');
    }

    // return login token for SPA
    public function loginApi(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken
            ]);
        } else {
            return response()->json([
                'user' => null,
                'token' => null
            ]);
        }
    }

    // return register token for SPA
    public function registerApi(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        User::create($data);

        $user = User::where('email', $request->email)->first();
        if (isset($user) && Hash::check($request->password, $user->password)) {
            return response()->json([
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken
            ]);
        } else {
            return response()->json([
                'user' => null
            ]);
        }
    }
}
