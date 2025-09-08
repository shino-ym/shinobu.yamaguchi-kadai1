@extends('layouts.app')

@section('nav')
        <a href="{{ route('register') }}" class="nav-link">register</a>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-form__content">
    <div class="form-title">
        <h2>Login</h2>
    </div>
    <form class="form" action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-wrapper">
            <div class= form-item>
                <span class="form__label--item">メールアドレス</span>
                    <div class="form__input--text">
                    <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}" />
                    </div>
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
            </div>
            <div class= form-item>
                <span class="form__label--item">パスワード</span>
                    <div class="form__input--text">
                    <input type="password" name="password" placeholder="例:coachtech1306" value="{{ old('password') }}"/>
                    </div>
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
            </div>
            <div class= form-item>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
