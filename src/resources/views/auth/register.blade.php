@extends('layouts.app')

@section('nav')
    <a href="{{ route('login') }}" class="nav-link">Login</a>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-form__content">
    <div class="form-title">
        <h2>Register</h2>
    </div>


    <form class="form" action="/register" method="post">
        @csrf
        <div class="form-wrapper">
            <div class= form-item>
                <span class="form__label--item">お名前</span>
                    <div class="form__input--text">
                    <input type="text" name="name" placeholder="例：山田 太朗"value="{{ old('name') }}" />
                    </div>
                        <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                        </div>
            </div>
            <div class= form-item>
                <span class="form__label--item">メールアドレス</span>
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
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
                    <input type="password" name="password" placeholder="coachtech1106" />
                </div>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
            </div>
            <div class= form-item>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">登録</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
