<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // login.blade.php を返す
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            // 認証に失敗した場合
            return back()->withInput();
        }

        // 認証成功 → 管理画面へ
        return redirect('admin'); // 例：管理画面のルート名
    }
}
