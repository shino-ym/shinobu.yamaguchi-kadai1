<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <div class="header__logo">
                    FashionablyLate
                </div>
            </div>
            <nav class="header-nav">
                <a href="{{ route('login') }}" class="nav-link">Logout</a>
            </nav>
        </div>
    </header>
    <main>

<div class="contact-form__content">
    <div class="form-title">
        <h2>Admin</h2>
    </div>



<!-- 検索機能 -->
<form class="search-form" action="{{ route('admin.index') }}" method="get">
    <div class="search-form__row">
        <!-- キーワード -->
        <input class="keyword-input" type="text" name="keyword"placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">

        <!-- 性別 -->
        <select name="gender" class="gender-select">
            <option value="">性別</option>
            @foreach($genders as $key => $value)
                <option value="{{ $key }}" {{ isset($params['gender'])&& (int)$params['gender'] === $value ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>

        <!-- 種類 -->
        <select name="category_id" class="category-select">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <!-- 日付 -->
        <input type="date" name="date" class="date-input">

        <!-- 検索ボタン -->
        <button type="submit" class="submit-btn">検索</button>

        <!-- リセットボタン -->
        <button type="reset" class="reset-btn">リセット</button>
    </div>
</form>

<!-- エクスポート・ページネーション -->
    <div class="export-pagination-wrapper">
        <div class=export-btn>
            <a href="{{ route('admin.export', request()->query()) }}" class="export-link">エクスポート</a>
        </div>
        <div class="pagination-wrapper">
            {{ $contacts->links(('vendor.pagination.custom')) }}
        </div>
    </div>
<!-- リスト -->
<table class="contact-table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
@foreach($contacts as $contact)
    <tr>
        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
        <td>{{ $genders[$contact->gender] }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->category->content ?? '未分類'}}</td>
        <td>
            <button class="detail-btn" onclick="openModal({{ $contact->id }})">詳細</button>
        </td>
    </tr>
@endforeach
    </tbody>
</table>

{{-- モーダルは foreach の外で生成 --}}
@foreach($contacts as $contact)
<div id="modal-{{ $contact->id }}" class="modal">
    <div class="modal-content">
        <!-- 右上の閉じるボタン -->
        <button class="close-modal" onclick="closeModal({{ $contact->id }})">&times;</button>

        <div class="modal-info">
            <div class="modal-info-row">
                <div class="label">お名前</div>
                    <div class="value">{{ $contact->last_name }} {{ $contact->first_name }}</div>
            </div>
            <div class="modal-info-row">
                <div class="label">性別</div>
                <div class="value">{{ $genders[$contact->gender] }}</div>
            </div>
            <div class="modal-info-row">
                <div class="label">メールアドレス</div>
                <div class="value">{{ $contact->email }}</div>
            </div>
            <div class="modal-info-row">
                <div class="label">電話番号</div>
                <div class="value">{{ $contact->tel1 }}-{{ $contact->tel2 }}-{{ $contact->tel3 }}</div>
            </div>
            <div class="modal-info-row">
                <div class="label">住所</div>
                <div class="value">{{ $contact->address }}</div>
            </div>
            <div class="modal-info-row">
                <div class="label">建物名</div>
                <div class="value">{{ $contact->building }}</div>
            </div>
            <div class="modal-info-row">
                <div class="label">お問い合わせの種類</div>
                <div class="value">{{ $contact->category->content ?? '未分類' }}</div>
            </div>
            <div class="modal-info-row">
                <div class="label">お問い合わせ内容</div>
                <div class="value">{{ $contact->detail }}</div>
            </div>

        <form action="{{ route('admin.delete', $contact->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">削除</button>
        </form>
    </div>
</div>


    </div>
</div>
@endforeach

@section('scripts')
<script>
function openModal(id) {
    document.getElementById('modal-' + id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById('modal-' + id).style.display = 'none';
}
</script>
</main>
</body>

</html>



