@extends('layouts.contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="form-title">
        <h2>Contact</h2>
    </div>
    <form action="{{ route('contacts.confirm') }}" method="post">
        @csrf
        <div class="form-wrapper">
            <div class="form-group">
                <label for="name" class="form__label--item">お名前 <span class="required">※</span></label>
                <div class="name-box">
                    <div class="name-field">
                        <input type="text" id="last_name" name="last_name" placeholder="例:山田" value="{{ old('last_name') }}" >
                        <div class="form__error">@error('last_name'){{ $message }}@enderror</div>
                    </div>
                    <div class="name-field">
                        <input type="text" id="first_name" name="first_name" placeholder="例:太郎" value="{{ old('first_name') }}" >
                        <div class="form__error">@error('first_name'){{ $message }}@enderror</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="gender" class="form__label--item">性別 <span class="required">※</span></label>
                    <div class="input-box--inline">
                        <span class="radio-item">
                            <input type="radio" id="male" name="gender" value="1" @checked(old('gender') == 1) checked>
                            <label for="male">男性</label>
                        </span>
                        <span class="radio-item">
                            <input type="radio" id="female" name="gender" value="2" @checked(old('gender') == 2)>
                            <label for="female">女性</label>
                        </span>
                        <span class="radio-item">
                            <input type="radio" id="other" name="gender" value="3" @checked(old('gender') == 3)>
                            <label for="other">その他</label>
                        </span>
                    </div>
                    <div class="form__error">
                    @error('gender'){{ $message }}@enderror
                    </div>
            </div>

            <div class="form-group">
                <label for="email" class="form__label--item">メールアドレス <span class="required">※</span></label>
                    <div class="input-box">
                        <div class="input-field">
                            <input type="email" id="email" name="email" placeholder="例:test@example.com"  value="{{ old('email') }}" >
                            <div class="form__error">@error('email'){{ $message }}@enderror</div>
                        </div>
                    </div>
            </div>

            <div class="form-group">
                <label for="tel" class="form__label--item">電話番号 <span class="required">※</span></label>
                    <div class="input-box">
                        <div class="tel-field">
                            <input type="tel" id="tel1" name="tel1" pattern="\d{1,5}" placeholder= "080" value="{{ old('tel1') }}">
                            <div class="form__error">@error('tel1'){{ $message }}@enderror</div>
                        </div>
                        <span class="tel-separator">-</span>
                        <div class="tel-field">
                            <input type="tel" id="tel2" name="tel2" pattern="\d{1,5}" placeholder= "1234" value="{{ old('tel2') }}">
                            <div class="form__error">@error('tel2'){{ $message }}@enderror</div>
                        </div>
                        <span class="tel-separator">-</span>
                        <div class="tel-field">
                            <input type="tel" id="tel3" name="tel3" pattern="\d{1,5}" placeholder= "5678" value="{{ old('tel3') }}">
                            <div class="form__error">@error('tel3'){{ $message }}@enderror</div>
                        </div>
                    </div>
            </div>

            <div class="form-group">
                <label for="address" class="form__label--item">住所 <span class="required">※</span></label>
                    <div class="input-box">
                        <div class="input-field">
                            <input type="text" id="address" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3"  value="{{ old('address') }}" >
                            <div class="form__error">@error('address'){{ $message }}@enderror</div>
                        </div>
                    </div>
            </div>

            <div class="form-group">
                <label for="building" class="form__label--item"> 建物名 </label>
                    <div class="input-box">
                        <input type="text" id="building" name="building" placeholder="例:千駄ヶ谷マンション101"  value="{{ old('building') }}" >
                    </div>
            </div>

            <div class="form-group">
                <label for="category_id" class="form__label--item"> お問い合わせの種類 <span class="required">※</span></label>
                    <div class="input-box--inline">
                        <div class="input-field">
                            <select name="category_id">
                                <option value="">選択してください</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->content }}
                                        </option>
                                    @endforeach
                            </select>
                            <div class="form__error">@error('category_id'){{ $message }}@enderror</div>
                        </div>
                    </div>
            </div>
            <div class="form-group">
            <!-- <div class="form-group form-group--textarea"> -->
                <label for="detail" class="form__label--item">お問い合わせ内容 <span class="required">※</span></label>
                    <div class="input-box">
                        <div class="input-field">
                            <textarea id="detail" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                            <div class="form__error">@error('detail'){{ $message }}@enderror</div>
                        </div>
                    </div>
            </div>

            <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </div>
    </form>
</div>
@endsection
