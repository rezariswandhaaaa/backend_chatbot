<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        // Validasi input yang masuk
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial apakah benar
        if (Auth::attempt($credentials)) {
            // Jika sukses, ambil user yang terautentikasi
            $user = Auth::user();

            // Kembalikan respons sukses tanpa token
            return response()->json([
                'message' => 'Login Successful',
                'user' => $user, // Anda bisa mengembalikan data user jika diperlukan
            ]);
        }

        // Jika gagal, kembalikan respons Unauthorized
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['message' => __($status)], 400);
    }
}
