<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contact;


class RegisterController extends Controller
{
    // 登録フォームを表示
    public function showRegisterForm()
    {
        return view('auth.register'); // resources/views/auth/register.blade.php を作る前提
    }
// ユーザー登録＋contents保存＋ログイン
    public function store(RegisterRequest $request)
    {
        // バリデーション済みデータを取得
        $data = $request->validated();

        // パスワードはハッシュ化
        $data['password'] = Hash::make($data['password']);

        // User 作成
        $user = User::create($data);

        // 自動ログイン
        auth()->login($user);

        return redirect('/login');
    }
}
